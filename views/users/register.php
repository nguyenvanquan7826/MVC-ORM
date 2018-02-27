<h3>Register</h3>

<?php if ($data['saved']) : ?>
    <div class='alert alert-info' role='alert'>
        <?php echo $data['saved'] ?>
    </div>
<?php endif; ?>

<form action="<?php url('/users/register') ?>" method="POST">
    <input type="text" name="name" class="form-control" placeholder="Your name"/><br/>
    <input type="text" name="email" class="form-control" placeholder="Your email"/><br/>
    <input type="password" name="password" class="form-control" placeholder="your password"> <br>
    <button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
</form>