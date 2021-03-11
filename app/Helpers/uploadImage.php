<?php
//helper create by Dennys

/*
 * $upload['file'] = $request->file('images); //array multi position
 * $upload['path] = $upload['path'] = storage_path('app/public/images/product/');
 */

function uploadImagem($upload)

{
    $return['success'] = 0;
    $return['error'] = 0;
    $return['images'] = [];

    if(isset($upload['files']) && count($upload['files'])) {

        // create new image with transparent background color
        $backgroundSmall = Image::canvas(200, 200);
        $backgroundLarger = Image::canvas(730, 730);

        @mkdir($upload['path'].'small', 0777, true);
        @mkdir($upload['path'].'larger', 0777, true);


        foreach($upload['files'] as $file) {

            try {
                $newName = time().'.'.strtolower($file->extension());

                $imgSmall = Image::make($file->path())->resize(180,180, function($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });

                $imgLarger = Image::make($file->path())->resize(750,750, function($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });

                $backgroundSmall->insert($imgSmall,'center');
                $backgroundLarger->insert($imgLarger,'center');

                $backgroundSmall->save($upload['path'].'small/'.$newName);
                $backgroundLarger->save($upload['path'].'larger/'.$newName);

                $return['images'][] = $newName;

                ++$return['success'];

            } catch (\Exception $e) {
                ++$return['error'];
            }

        }

    }

    return $return;

}
