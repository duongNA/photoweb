<div class="search">
<?php
  echo $this->Form->create();
  echo $this->Form->input('searchstring',array('label'=>'','placeholder'=>'Search string'));
  echo $this->Form->end('Search');
?>
</div>
<h1 class="manage-title">Album Management</h1>
<table>
  <tr>
    <th>
       Album title
    </th>
    <th>
      Owner
    </th>
    <th>
      Created
    </th>
    <th colspan="2">
      Operations
    </th>
  </tr>
    <?php foreach($albums as $album): ?>
      <tr>

        <td>
          <?php echo $this->Html->link($album['Album']['title'],array('controller'=>'albums','action'=>'view',$album['Album']['id'])) ; ?>
        </td>
        <td>
          <?php
            echo $this->Html->link($album['User']['username'],array('controller'=>'users','action'=>'view',$album['User']['id']));
          ?>
        </td>
        <td>
          <?php
            echo $album['Album']['created'];
          ?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'albums','action'=>'edit',$album['Album']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'albums','action' => 'delete', $album['Album']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->Paginator->numbers();?>
