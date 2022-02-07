<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeroResource;
use App\Http\Resources\OtherResource;
use App\Models\Hero;
use App\Models\Other;
use App\Models\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class OtherController extends Controller
{
    public function index(Other $other)
    {
        $other->post->views++;
        $other->post->save();
        return OtherResource::collection(Other::where('id', $other->id)->get());
    }

    public function getother(Other $other)
    {
        return OtherResource::collection(Other::where('id', $other->id)->get());
    }

    public function store(Request $request)
    {

        $DATA = [];
        $DATA['other'] = (array)json_decode($request->input('other'));
        $DATA['image_other'] = $request->file('image_other');

        $validator = $this->checkValid($DATA, $DATA['other']['is_active']);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                DB::beginTransaction();
                //----------------------- POST -----------------------------------------
                $post = new Post();
                $post->user_id = Auth::id();
                $post->post_type_id = 3;
                $post->is_active = $DATA['other']['is_active'];
                if ($DATA['other']['is_active'] == 1) {
                    $post->is_published = date("Y-m-d H:i:s");
                    Auth::user()->add_points(30,'Created OTHER post');
                }
                $post->save();


                //----------------------- OTHER ----------------------------------------
                $other = new Other();
                $other->post_id = $post->id;
                $this->createOther($other, $DATA['other']);
                $other->save();

                $this->addNewImage($other, $DATA['image_other'], '_other_image', 450, 320);



                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Post successfully created.',
                    'post_id' => $other->id,
                ], 201);

            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Throwable',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Exception',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        }
    }

    public function update(Request $request)
    {

        $DATA = [];
        $DATA['other'] = (array)json_decode($request->input('other'));
        $DATA['image_other'] = $request->file('image_other');

        $validator = $this->checkValid($DATA, $DATA['other']['is_active']);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                    'errors' => $validator->errors(),
                ], 201);
            } else {
                DB::beginTransaction();

                $other = Other::where('id', $DATA['other']['id'])->first();
                if (!Gate::allows('update-post', $other->post)) {
                    abort(403);
                }

                //----------------------- POST -----------------------------------------
                $other->post->is_active = $DATA['other']['is_active'];
                if ($DATA['hero']['is_active'] == 1 && !$other->post->is_published) {
                    $other->post->is_published = date("Y-m-d H:i:s");
                    Auth::user()->add_points(30,'Created OTHER post');
                }
                $other->post->save();

                //----------------------- OTHER ----------------------------------------
                $this->createOther($other, $DATA['other']);
                $other->save();

                $this->addNewImage($other, $DATA['image_other'], '_other_image', 450, 320);



                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Post successfully created.',
                    'post_id' => $other->id,
                ], 201);

            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Throwable',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Exception',
                'errors' => $e->getMessage()
//                    'errors' => ["Internal Server Error. Please refresh the page and try again."],
            ], 201);
        }
    }


    public function addNewImage($save_target, $data_image, $subfix, $width, $height)
    {
        if ($data_image) {
            $input['imagename'] = rand(111, 999) . time() . $subfix . '.jpg';
            $destinationPath = public_path('/img_public');
            $save_target->img_path = '/img_public/' . $input['imagename'];
            $save_target->img_is_uploaded = true;
            $save_target->save();

            $img = Image::make($data_image->getRealPath());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename'], 90, 'jpg');
        }
    }

    public function createOther($initialOther, $data)
    {
        $initialOther->name = $data['name'];
        $initialOther->description = $data['description'];
        $initialOther->other_flags_id = $data['other_flags_id'];
    }

    public function checkValid($DATA, $active)
    {
        if ($active == 0) {
            $validator = Validator::make($DATA, [
                'other.name' => 'required|max:40',
            ],
                [
                    'item.name.required' => 'The name or tittle is required.',
                ]);
        } else {
            $validator = Validator::make($DATA, [
                'other.name' => 'required|min:2|max:40',
                'other.description' => 'required|min:50|max:4000',
                'image_other' => 'nullable|mimes:jpg,png|max:2048',

            ]);
        }
        return $validator;
    }
}
