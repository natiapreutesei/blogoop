<?php
    /*create*/
    /*$photo = new Photo();
    $photo->title = "Sam";
    $photo->description = "Lore ipsuim";
    $photo->filename = "image.jpg";
    $photo->type = "jpg";
    $photo->size = "35";
    $photo->save();*/

    /*update*/
    $photo = Photo::find_by_id(2);
    $photo->title = "Samuel";
    $photo->save();

    /*all photos*/
    $photos = Photo::find_all();
    foreach ($photos as $photo) {
        echo $photo->title . "<br>";
    }

?>