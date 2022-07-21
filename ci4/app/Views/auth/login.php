<?= $this->extend('main_auth') ?>

<?= $this->section('isi') ?>

     <!-- Begin page -->
     <div class="blockSign">
        <div id="formContent">

                <div id="signin">
                    <div><br></div>
                    <a style="margin-top: 10px;" href="" class="logo logo-admin mt-4"><img src="<?= base_url('assets/images/Logo-Dukcapil-Mojokerto.png') ?>" alt="" height="80"></a>
                    <p>Isi form dibawah untuk masuk!</p>
                    <?= form_open('login/validasi', ['class' => 'formlogin']) ?>
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" placeholder="Username" name="username" id="username" class="fadeIn " />
                            <div class="invalid-feedback errorUsername">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" id="password"  class="fadeIn ">
                            <div class="invalid-feedback errorPassword">
                        </div>
                        <input type="submit" value="Masuk"></input>
                        <p id="formFooter"><a href="https://dispenduk.mojokertokota.go.id/">Kembali ke Website Dispendukcapil Kota Mojokerto</a></p>
                    <?= form_close() ?>
                </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.formlogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnlogin').prop('disable', true);
                        $('.btnlogin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...')

                    },
                    complete: function() {
                        $('.btnlogin').prop('disable', false);
                        $('.btnlogin').html('Login')
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('.errorUsername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('.errorUsername').html();
                            }

                            if (response.error.password) {
                                $('#password').addClass('is-invalid');
                                $('.errorPassword').html(response.error.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('.errorPassword').html();
                            }
                        }

                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil login!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1250
                            }).then(function() {
                                window.location = response.sukses.link;
                            });

                        }

                        if (response.nonactive) {
                            Swal.fire({
                                title: "Oooopss!",
                                text: "User belum aktif!",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1250
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>

<?= $this->endSection('isi') ?>