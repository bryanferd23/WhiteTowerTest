<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>Sign-Up<?= $this->endSection() ?>

<?= $this->section('main') ?>

    <div class="container d-flex justify-content-center p-5">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <div class="text-center mb-5 mt-4">
                    <h5 class="card-title">Sign-Up</h5>
                </div>

                <?php if (session('error') !== null) : ?>
                    <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                                <?= $error ?>
                                <br>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?= session('errors') ?>
                        <?php endif ?>
                    </div>
                <?php endif ?>

                <form action="<?= url_to('register.action') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row mb-4">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingFirstNameInput" name="first_name" inputmode="text" autocomplete="first-name" placeholder="First Name" value="<?= old('first_name') ?>" required>
                                <label for="floatingFirstNameInput">First Name</label>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingLastNameInput" name="last_name" inputmode="text" autocomplete="last-name" placeholder="Last Name" value="<?= old('last_name') ?>" required>
                                <label for="floatingLastNameInput">Last Name</label>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        <label for="floatingEmailInput">Email</label>
                    </div>

                    <!-- Username -->
                    <!-- <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                        <label for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
                    </div> -->


                    <!-- Password -->
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                        <label for="floatingPasswordInput">New Password</label>
                    </div>

                    <!-- Password (Again) -->
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                        <label for="floatingPasswordConfirmInput">Confirm Password</label>
                    </div>

                    <div class="d-grid col-12 col-md-8 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block">SIGN UP</button>
                    </div>

                    <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>">Log-in</a></p>

                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
