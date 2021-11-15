</main>
</div>
<?php if(!$_SESSION['user']['id']){ ?>
<div class="modal overlay">
    <div class="container modal__body" id="login-modal">
        <div class="modal-close">
            <button class="modal-close__btn chest-icon"></button>
        </div>
        <section class="wrapper">
            <h2 class="tweet-form__title">Введите логин и пароль</h2>
            <?php  ?>
            <div class="tweet-form__error"><?php if($error){ echo $error; }?></div>
            <div class="tweet-form__subtitle">Если у вас нет логина, пройдите <a href="<?php echo get_url('register.php'); ?>">регистрацию</a></div>
            <form class="tweet-form" action="<?php echo get_url('include/sign_in.php');?>" method="post">
                <div class="tweet-form__wrapper_inputs">
                    <input type="text" class="tweet-form__input" placeholder="Логин" required name="login">
                    <input type="password" class="tweet-form__input" placeholder="Пароль" required name="passwd">
                </div>
                <div class="tweet-form__btns_center">
                    <button class="tweet-form__btn_center" type="submit">Войти</button>
                </div>
            </form>
        </section>
    </div>
</div>
<?php } ?>
<script src="<?php echo get_url('js/scripts.js'); ?>"></script>
<?php if($error){ ?>
<script> openModal();</script>
<?php } ?>
</body>
</html>
