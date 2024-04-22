<?= $this->include('content/sidebar') ?>
<?= $this->include('content/header') ?>

			<main class="content">
                <div class="container-fluid p-0">
                <h5 class="right-aligned" style="float: right">
                    <a href="#">Home</a> / <a href="#">User</a> / Update User
                </h5>
                <h1 class="h3 mb-3"><b>Update User</b></h1>
                    <div class="row">
                        <div class="col-12">
                        <form id="updateKaryawan" action="<?= base_url('karyawan/profil/update/' . $user['id_user']) ?>" method="post">
                            <div class="card">
                            <div class="card-body">
                                <!-- Inputan Nama Lengkap -->
                                <h5 class="card-title">Nama Lengkap</h5>
                                <input
                                type="text"
                                class="form-control"
                                id="username" name="username"
                                value="<?= esc($user['nama_user']) ?>"
                                required/>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <!-- Inputan Username -->
                                        <h5 class="card-title mt-2">Username</h5>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="username" name="username"
                                            value="<?= esc($user['username']) ?>"
                                            required/>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Inputan Nomor Handphone -->
                                        <h5 class="card-title mt-2">Nomor Handphone</h5>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="no_hp" name="no_hp"
                                        value="<?= esc($user['no_hp']) ?>"
                                        required/>
                                    </div>
                                </div>
                                
                                <!-- Button Submit -->
                                <div
                                style="
                                    position: relative;
                                    text-align: right;
                                    margin-top: 20px;
                                ">
                                <a onclick="history.back()"
                                    type="button"
                                    class="btn btn-info">
                                    Cancel
                                </a>
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    id="submitButton">
                                    Simpan
                                </button>
                                </div>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </main>

<?= $this->include('content/footer') ?>
<script src="<?= base_url('js/user/update_karyawan.js') ?>"></script>