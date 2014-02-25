<h1>Add Post</h1>
<?php
echo $this->Form->create('Process');
echo $this->Form->input('name');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>





