	<h1>Edit Post</h1>
<?php
echo $this->Form->create('Process', array('action' => 'edit'));
echo $this->Form->input('name');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');

?>