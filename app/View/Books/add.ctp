<!-- File: /app/View/Books/add.ctp -->

<?php echo $this->Form->create('Book') ;?>
  	<div class="form-group">
    	<label for="exampleInputEmail1">Title</label>
    	<?php
		echo $this->Form->input('Book.title', array(
		    'type' => 'text',
		    'label' => false,
		    'class' => "form-control",
		    'placeholder' => 'Book title'
		));
		?>
  	</div>
  	<div class="form-group">
    	<label for="exampleInputEmail1">Description</label>
    	<?php
		echo $this->Form->input('Record.description', array(
		    'type' => 'textarea',
		    'label' => false,
		    'class' => "form-control",
		    'placeholder' => 'Book title',
		    'rows' => '3'
		));
		?>
  	</div>
  	<button type="submit" class="btn btn-primary">Add new book</button>
</form>