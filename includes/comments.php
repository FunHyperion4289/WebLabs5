<?php
/**
 * @var array $errors
 * @var array $comments
 */
?>

<section class="article-comments">
    <h2>Comments (<?=count($comments) ?>)</h2>
    <form action="" method="post" class="form-container">
        <input type="hidden" name="action" value="new-comment">

        <!-- ім'я -->
        <div class="form-input-group">
            <input class="form-input-field" value="<?= htmlspecialchars($_POST['name']??'');?>" type="text" name="name" id="nameField" max="50" placeholder="Your name" require>
            <?php if (array_key_exists('name', $errors)) { ?>
                <div class="input-error"><?= $errors['name']; ?></div>
            <?php } ?>
        </div>
        
        <!-- оцінка -->
        <div class="form-input-group">
            <select class="form-input-field" name="rate" id="rateField" require>
                <option selected disabled>Rate this post</option>
                <?php 
                $ratings = [5, 4, 3, 2, 1];
                foreach ($ratings as $rating) {
                    $selected = (int)($_POST['rate']?? '') === $rating ? 'selected' : '';
                    echo "<option value='$rating' $selected>" . str_repeat('★', $rating) . "</option>";
                }
                ?>
            </select>
            <?php if (array_key_exists('rate', $errors)) { ?>
                <div class="input-error"><?= $errors['rate']; ?></div>
            <?php } ?>
        </div>

        <!-- текст коментаря -->
        <div class="form-input-group">
            <textarea class="form-input-field" name="content" id="contentField" cols="30" rows="10" max="200" placeholder="Write your comment here" require><?= htmlspecialchars($_POST['content']??''); ?></textarea>
            <?php if (array_key_exists('content', $errors)) { ?>
                <div class="input-error"><?= $errors['content']; ?></div>
            <?php } ?>
        </div>

        <button type="submit" class='btn'>Leave comment</button>
    </form>
    <div class="comments">
        <?php foreach ($comments as $comment) { ?>
        <div class="comment">
            <b class='comment-author' title='Comment author' ><?= htmlspecialchars($comment['author']); ?></b>
            <time class='comment-date' title='Comment time' datetime="<?= $comment['created']; ?>"><?= $comment['created']; ?></time>
            <span class='comment-rate' title='Rating'><?= str_repeat('✨', $comment['rate']); ?></span>
            <p class='comment-content'><?= nl2br(htmlspecialchars($comment['content']), false); ?></p>
        </div>
        <?php } ?>
    </div>
</section>        