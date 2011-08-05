<h3>Home</h3>

<p>Welcome to Wubbles, a web app designed to store all of your most treasured memories throughout your life..</p>
<p>We want to take a progressive approach to keeping track of memories.  Update your account with your past memories, while you 
continue to add memories as you continue though life.</p>
<p>Your privacy is important and we understand that some memories aren't meant for the general public.  Only share what you want, to whom you want.  Or share it with everyone, its up to you.</p>

<?php 
if (!empty(Wub_Controller::$example_id)):?>
    <div class='example'>
        <p>We have set up an <a href='<?php echo Wub_Controller::$url?>account/<?php echo Wub_Controller::$example_id?>'>example</a> account for you to look at.  
        Check out the <a href='<?php echo Wub_Controller::$url?>account/<?php echo Wub_Controller::$example_id?>/timeline'>timeline</a>.</p>
    </div>
<?php endif;?>

<div class='features'>
    <b>Features</b>
    <ul>
        <li>Add your most cherished memories.</li>
        <li>Privacy settings, share your memories with who you want.</li>
        <li>Upload photos to your memories</li>
        <li>Comments on both memories and photos.</li>
        <li>A time line of your memories</li>
        <li>Receive notifications when friends share memories with you or when someone comments on your memories</li>
        <li>A social experiance.  Add your freinds and family, and recieve updates when they add content.</li>
    </ul>
</div>



<p>This is still a work in progress.</p>
Todo:
<ul>
    <li>Allow selected friends to add to your memories.</li>
    <li>General layout, ui, and flow improvements</li>
    <li>Family support</li>
    <li>Category Support</li>
</ul>