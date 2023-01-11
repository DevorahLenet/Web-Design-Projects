<h1 class="profile_title"><?php echo $signed_in_user->name ?></h1>
<h2>My Info:</h2>

<!-- Now we display the user's contact method based on what they preferred be made public -->
<?php 
    if($signed_in_user->contact_preference == "email"){
        ?>
        <p>Email: <span class="regular_text_sml"><?php echo $signed_in_user->email ?></span></p>
    <?php
    }elseif($signed_in_user->contact_preference == "phone"){
        ?>
        <p>Phone Number: <span class="regular_text_sml"><?php echo $signed_in_user->phone ?></span></p>
    <?php
    }elseif($signed_in_user->contact_preference == "phone and email"){
        ?>
        <p>Email: <span class="regular_text_sml"><?php echo $signed_in_user->email ?></span></p>
        <p>Phone Number: <span class="regular_text_sml"><?php echo $signed_in_user->phone ?></span></p>
    <?php
    }
?>

<p>Location: <span class="regular_text_sml"><?php echo $signed_in_user->city ?>, 
                <?php echo $signed_in_user->state ?> (<?php echo $signed_in_user->country ?>)</span></p>
<h2>About Me:</h2>
<span class="regular_text_sml"><?php echo $signed_in_user->bio ?></span>
