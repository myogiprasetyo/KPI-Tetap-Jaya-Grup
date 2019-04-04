<section class="content-header">
    <h1>
<?php
        if (empty($up_konten)) {
            echo $konten;
        } else {
            echo $up_konten;
            echo '<small>&nbsp;&nbsp;'.$konten.'</small>';
        }
?>
    </h1>

    <ol class="breadcrumb">
<?php
        if (empty($up_konten)) {
?>
            <li>
                <a>
                    <i class="fa <?php echo $icon; ?>"></i>
<?php
                        echo $konten;
?>
                </a>
            </li>
<?php
        } else {
?>
            <li>
                <a href="<?php echo site_url().'Pemasok/'.str_replace(' ', '', $up_konten); ?>">
                    <i class="fa <?php echo $icon; ?>"></i>
<?php
                        echo $up_konten;
?>
                </a>
            </li>
            
            <li class="active">
<?php
                echo $konten;
?>
            </li>
<?php
        }
?>
    </ol>
</section>