<?php

namespace App\Console\Commands;

use App\Models\Mrc;
use App\Models\MrcSpell;
use App\Models\MrcVote;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MrcEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mrc:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Finishes the current MRC and initializes the next one.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            //GET CURRENT MRC
            $current_mrc = Mrc::where('is_active', 1)->first();
            //finish it
            $current_mrc->is_active = 0;
            //get most voted post
            $mrc_most_voted_spells = DB::table('mrc_votes')
                ->selectRaw('SUM(vote) as total_votes, mrc_spell_id')
                ->where('mrc_id', '=', $current_mrc->id)
                ->groupBy('mrc_spell_id')
                ->orderBy('total_votes', 'desc')
                ->get();

            //ver si hay ganador
            if ($mrc_most_voted_spells->count() > 0) {
                $mrc_most_voted_spell = $mrc_most_voted_spells[0];
                //buscar el spell ganador
                $winner_spell = MrcSpell::where('id', $mrc_most_voted_spell->mrc_spell_id)->first();
                //buscar el user
                $winner_user = User::where('id',$winner_spell->user_id)->first();
                //asignar ganador en el mrc
                $current_mrc->winner_entry_id = $winner_user->id;
                //asignar puntos y shards
                $winner_user->add_points(2000,'WON MRC - Congratz!');
                $winner_user->add_coins(1000,'WON MRC - Congratz!');

            } else {
                $this->info("No Spells - Prize vacancy");
            }
            //cerrar current mrc
            $current_mrc->save();
            $this->info("Mrc id " . $current_mrc->id . " finished.");

            //buscar proximo mrc
            $next_mrc_id = Mrc::where('id', '>', $current_mrc->id)->min('id');
            if ($next_mrc_id) {
                $next_mrc = Mrc::where('id', $next_mrc_id)->first();
                $this->info("Seteando proximo Mrc id " . $next_mrc->id . ".");
                $next_mrc->is_active = 1;
                $next_mrc->save();
            }else{
                $this->info("Advertencia. No hay proximo MRC.");
            }


            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->info($exception->getMessage());
        } catch (\Throwable $exception) {
            DB::rollBack();
            $this->info($exception->getMessage());
        }

//
//
//
//
//
//
//        //GET LIST OF MRCS
//        $mrcs = Mrc::all();
//
//
//
//
//
//
//
//        if (date('t') == date('d')) {
//            echo 'Last day of the month.';
//        }

        return 0;
    }
}
