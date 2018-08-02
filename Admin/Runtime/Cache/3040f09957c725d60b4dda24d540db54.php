<?php if (!defined('THINK_PATH')) exit();?><tr>
    <th></th>
    <th>ID</th>
    <th>用户名</th>
    <th>头像</th>
    <th>邮箱</th>
    <th>添加时间</th>
    <th>上次登录时间</th>
    <th>修改</th>
    <th>删除</th>
</tr>
<?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
        <td><input type="checkbox" uid="<?php echo ($row[id]); ?>"></td>
        <td><?php echo ($row[id]); ?></td>
        <td><?php echo ($row['username']); ?></td>
        <td>
            <?php if(!empty($row['img'])): ?><img src="<?php echo ($row['img']); ?>" width="50px" height="50px">
                <?php else: ?>
                无<?php endif; ?>
        </td>
        <td><?php echo ($row['email']); ?></td>
        <td><?php echo date('Y年m月d日 H:i',$row['regtime']);?></td>
        <td><?php echo date('Y年m月d日 H:i',$row['lastred']);?></td>
        <td><a href="__URL__/edituser/id/<?php echo ($row['id']); ?>">修改</a> </td>
        <td><a href="javascript:" class="del" uid="<?php echo ($row[id]); ?>">删除</a> </td>
    </tr><?php endforeach; endif; ?>
<tr>
    <td colspan="1">
        <a href="javascript:" class="all">全选</a>
    </td>
    <td colspan="1">
        <a href="javascript:" class="delall">删除</a>
    </td>
    <td colspan="1">
        <?php if($order==1): ?><a href="?seq=0">倒序</a>
            <?php else: ?>
            <a href="?seq=1">正序</a><?php endif; ?>
    </td>
    <td colspan="6"><?php echo ($show); ?></td>
</tr>