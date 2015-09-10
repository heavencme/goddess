<?php 
$data=array(
        "comment"=> "http://octodex.github.com/",
        "invited"=> array(
            array(
              "fullName"=> "the Mardigrastocat",
              "urlToken"=> "mardigrastocat",
              "avatarPath"=> "http://octodex.github.com/images/Mardigrastocat.png",
              "bio"=> "Octodex",
              "id"=> 1
            ),
            array(
              "fullName"=> "the Kimonotocat",
              "urlToken"=> "kimonotocat",
              "avatarPath"=> "http://octodex.github.com/images/kimonotocat.png",
              "bio"=> "Octodex",
              "id"=> 2
            ),
            array(
              "fullName"=> "the Skitchtocat",
              "urlToken"=> "skitchtocat",
              "avatarPath"=> "http://octodex.github.com/images/skitchtocat.png",
              "bio"=> "Octodex",
              "id"=> 3
            )
        ),
        "recommended"=> array(
            array(
              "fullName"=> "the Droidtocat",
              "urlToken"=> "droidtocat",
              "avatarPath"=> "http://octodex.github.com/images/droidtocat.png",
              "bio"=> "Octodex",
              "id"=> 4
            ),
            array(
              "fullName"=> "the Goretocat",
              "urlToken"=> "goretocat",
              "avatarPath"=> "http://octodex.github.com/images/goretocat.png",
              "bio"=> "Octodex",
              "id"=> 5
            ),
            array(
              "fullName"=> "the FIRSTocat",
              "urlToken"=> "firstocat",
              "avatarPath"=> "http://octodex.github.com/images/FIRSTocat.png",
              "bio"=> "Octodex",
              "id"=> 6
            ),
            array(
              "fullName"=> "the Professortocat",
              "urlToken"=> "professortocat",
              "avatarPath"=> "http://octodex.github.com/images/Professortocat_v2.png",
              "bio"=> "Octodex",
              "id"=> 7
            )
        )
    );
    $data=json_encode($data);
    header('Content-Type: application/json');
    print_r($data);
?>
