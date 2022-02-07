<?php
$dota2heroes = \App\Models\Dota2Hero::all();
?>


<p>Attack Speed is the frequency with which units attack is measured. A unit's attack speed can be modified by items, per point of Agility attribute agility, abilities providing flat bonuses and auras.</p>

<h2>Base Attack Time</h2>
<p>Every unit has a base attack time (BAT), which refers to the default interval between attacks for a unit without considering any bonus yet. Most heroes start with <strong>1.7</strong> BAT.</p>
<h2>Increase Attack Speed</h2>
<p>Most units have an increase attack speed (IAS) of <strong>100</strong>, which refers to the default base speed from where bonuses will apply. IAS can be increased by using abilities, passives, auras, items, and agility.</p>
<p>Each point of agility gives <strong>1</strong> IAS</p>
<p>The total attack speed value has a minimum of <strong>20</strong> and an maximum value of <strong>700</strong> and a unit's attack speed cannot be reduced or increased beyond the the values above.
</p>
<h2>Attack Speed Calculation</h2>
<p>Using a hero's BAT and IAS, their attack speed is calculated using this formula</p>
<p class="text-center font-mono text-primary-icon">
    AS = (IAS + agility) / (100 * BAT)
</p>


<h2>Attack Rate</h2>
<p>Dividing 1 by the AS, we can get the time between attacks (the number displayed in the game).</p>
<p class="text-center font-mono text-primary-icon">
    AR = 1 / AS
</p>
<h2>Dota 2 Hero's Attack Speed table</h2>
<div class="long_text">

    <table class="article_table table_bordered">
        <thead>
        <tr>
            <th></th>
            <th>Hero</th>
            <th>BAT</th>
            <th>IAS lvl 1</th>
            <th>AS</th>
            <th>AR</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dota2heroes as $dota2hero)
            <tr>
                @if($dota2hero->json_name == 'dawnbreaker')
                    <td class="text-center w-16"><img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/heroes/dawnbreaker.png" alt="hero" class="object-cover w-full h-full"></td>
                @else
                    <td class="text-center w-16"><img src="http://cdn.dota2.com/apps/dota2/images/heroes/{{$dota2hero->json_name}}_sb.png" alt="hero" class="object-cover w-full h-full"></td>
                @endif
                <td>{{$dota2hero->name}}</td>
                <td class="text-center">{{$dota2hero->attack_bat}}</td>
                <td class="text-center">{{$dota2hero->attack_ias + $dota2hero->agility}}</td>
                <td class="text-center">{{number_format(($dota2hero->attack_ias + $dota2hero->agility)/($dota2hero->attack_ias * $dota2hero->attack_bat),2)}}</td>
                <td class="text-center text-primary-icon">{{number_format(1/(($dota2hero->attack_ias + $dota2hero->agility)/(100 * $dota2hero->attack_bat)),2)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="flex items-center">
    @include('svgs',['svg' => 'update','classes' => 'h-5 w-5 mr-2 text-primary-accent-sub'])
    <p class="text-sm text-primary-text-muted">Last update patch 7.31c</p>
</div>
