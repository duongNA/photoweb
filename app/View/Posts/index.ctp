<script type="text/javascript">
  $(function(){
    /* $('.box-content > img').hover(function() {
      $(this).next('.meta').removeClass('hide');    
    }, function() { 
      $(this).next('.meta').addClass('hide');   
    }) */

    $('.box-content').live({
      mouseenter: function() {
        $(this).children('.meta').show(300);
      },
      mouseleave: function() {
        $(this).children('.meta').hide(300);
      }
    });

    

  });
</script>

<div id="main-container">
  <?php foreach ($posts as $post): ?>
  <div class="box">
    <div class="box-content">
      <a rel="fancybox" href="<?php echo $this->Html->url("/files/post/image/".$post['Post']['image_dir']."/".$post['Post']['image']); ?>" class="fancybox" title="<?php echo $post['Post']['title']; ?>">
        <?php echo $this->Html->image("/files/post/image/".$post['Post']['image_dir']."/".$post['Post']['image']); ?>
      </a>
      <div class="meta hide">
        <div class="title">
          <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id']))?>
        </div>
        <div class="owner-block">
          <span class="owner">
            <span>by </span>
            <?php echo $this->Html->link($post['PostOwner']['username'], array('controller' => 'users', 'action' => 'view', $post['PostOwner']['id'])); ?>
          </span>
          <span class="viewed">
            <span>Viewed :</span>
            <?php echo $post['Post']['viewed'];?>
          </span>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

</div>

<nav id="page_nav">
  <?php 
      if($this->Paginator->hasPage(2)) {
      echo $this->Paginator->next('Next Page');
    } 
    ?>
</nav>