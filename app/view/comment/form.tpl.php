<div class='comment-form'>

    <form method=post>
        <?php if( isset($id)): ?>
            <h2>Redigera kommentar</h2>
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type=hidden name="redirect" value="<?=$_SERVER['HTTP_REFERER']?>">
        <?php else: ?>
            <h2>Kommentera '<?= htmlentities($title, null, 'utf-8'); ?>'</h2>
            <input type=hidden name="redirect" value="<?=$this->request->getCurrentUrl()?>#comments">
        <?php endif; ?>

        <?php if( $pageIdentifier ): ?>
        <input type="hidden" name="digest" value="<?=$pageIdentifier?>" />
        <input type="hidden" name="page" value="<?=$pageUrl?>" />
        <?php endif; ?>

        <p class="textarea">
        <img id="CommentGravatarImage" class="gravatar gravatar-small" src="http://www.gravatar.com/avatar/<?=md5($mail);?>.jpg?s=60" alt="[user gravatar]"  />
        <textarea placeholder="Skriv din kommentar här" name='content'><?=$content?></textarea>
        </p>

        <p class="instructions">Du kan använda HTML-taggarna &lt;a&gt;, &lt;strong;&gt;, &lt;b&gt;, &lt;i&gt; och &lt;em&gt;</p>

        <div class="commentator-details">
            <p><label>Namn: </label><input placeholder="Skriv ditt namn här" type='text' name='name' value='<?=$name?>'/></p>
            <p><label>E-post: </label><input class="gravatar" data-gravatar-target="#CommentGravatarImage" placeholder="Fyll i din e-post här" type='text' name='mail' value='<?=$mail?>'/> <small>(Används endast för gravatar-bild)</small></p>
            
            
            <p><label>Hemsida: </label><input placeholder="Skriv adressen till din hemsida här" type='text' name='web' value='<?=$web?>'/></p>
            <p class=buttons>
                <?php if( isset($id)): ?>
                <input type='submit' name='doEdit' value='Update' onClick="this.form.action = '<?=$this->url->create('comment/save')?>'"/>
                <a href="javascript:history.go(-1)">Cancel</a>
                <?php else: ?>
                <input type='submit' name='doCreate' value='Comment' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
                <input type='reset' value='Reset'/>
                <input type='submit' name='doRemoveAll' value='Remove all' onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
                <?php endif; ?>
            </p>
        </div>
        <output><?=$output?></output>
    </form>
</div>