<?php

use Illuminate\Support\Facades\DB;
// use File;

function photon_notification($errors){
    
    if(session()->has('message')):
        echo '<div class="alert alert-'.session()->get('type').'">'.session()->get('message').'</div>';
    endif;

    if($errors->any()):
    echo '<div class="alert alert-danger">';
      foreach ($errors->all() as $error):
            echo '<li>'. $error .'</li>';
      endforeach;
    echo '</div>';
    endif;


}



// Image Link

function photo_thumbnail($name, $root_dir=""){

    $link = substr($name,0,7);

    if($link === "https:/" || $link === "http://" ){
        return $name;
    }elseif($name === null){
        return asset('storage/images/default.jpg');

    }
    return asset($root_dir.'/'.$name);
}

function photon_thumbnail($name, $sub_dir=""){

    $link = substr($name,0,7);

    if($link === "https:/" || $link === "http://" ){
        return $name;
    }elseif($name === null){
        return asset('storage/images/default.jpg');

    }
    return asset('storage/images'.$sub_dir.'/'.$name);
}

 function photon_delete_image($name, $sub_dir=""){

    $link = substr($name,0,7);

    if($link === "https:/" || $link === "http://" ){
        return $name;
    }elseif($name === null){
        return asset('storage/images/default.jpg');

    }
    $image_path = 'storage/images'.$sub_dir.'/'.$name;
    if(file_exists($image_path)){
        //dd('file_exists');
        unlink($image_path);
    }

    //dd($image_path);
    return asset('storage/images'.$sub_dir.'/'.$name);
}

 function photon_delete_dir($dir){

    $dir_path = 'storage/images'.$dir;
    if(File::isDirectory($dir_path)){
        // dd('$dir_path');
        File::deleteDirectory($dir_path);

    }

    // dd($dir_path);
    return $dir_path;
}

 function photon_move_image($name, $from_dir, $to_dir){

    $link = substr($name,0,7);

    if($link === "https:/" || $link === "http://" ){
        return $name;
    }elseif($name === null){
        return asset('storage/images/default.jpg');

    }
    $from_image_path = 'storage/images'.$from_dir.'/'.$name;
    $to_image_path = 'storage/images'.$to_dir.'/'.$name;
    //dd($from_image_path);
    if(file_exists($from_image_path)){
        //dd('file_exists');
        if(!File::isDirectory('storage/images'.$to_dir)){

            File::makeDirectory('storage/images'.$to_dir, 0777, true, true);

        }
        File::move($from_image_path, $to_image_path);

   
    }

    //dd($image_path);
    return asset('storage/images'.$to_dir.'/'.$name);
}

function photon_image_process($request,$name, $sub_dir=""){
    //dd($name); 
     
    if($request->hasFile($name)){

        $validator = validator()->make($request->all(),[
            $name  => 'image',
       ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
        }

       
        $imgName = sprintf('%s.%s',str_random(10),$request->$name->extension());
   
        $request->$name->storeAs('public/images'.$sub_dir,$imgName);


    }else{

        $thumbUrl = sprintf("%s_url",$name);
         //dd($request->$thumbUrl);    
            if($request->$thumbUrl){

                //    Thumbnail URl Process Start

                $validator = validator()->make($request->all(),[
                    $thumbUrl  => 'active_url',
               ]);
        
                if($validator->fails()){
        
                    return redirect()->back()->withErrors($validator);
                }

                
                $imgName =  $request->$thumbUrl;

                //    Thumbnail URl Process End
     
            }else{

                $imgName = 'default.jpg';

            }
    


    }

    return $imgName;

}



// Check Selected 

function photon_selected($post,$item){


    return ($post == $item ) ? 'selected' : '';
}


function setting($key){
    
    try{
        $value = DB::table('settings')->where('key',$key)->first()->value;
        return $value;
    }catch(Exception $e){
        return;
    }
}
