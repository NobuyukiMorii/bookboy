<!-- File: /app/View/Books/view.ctp -->

<h1><?php echo h($Book['Book']['title']); ?></h1>

<p><small>Created: <?php echo $Book['Book']['created']; ?></small></p>

<p><?php echo h($Book['Book']['body']); ?></p>