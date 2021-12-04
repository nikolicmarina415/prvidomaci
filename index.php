<?php
    include './layout/header.php';
?>
<div class='container mt-2'>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forma preduzece</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="forma">
                        <div class="form-group">
                            <label for="sifraDelatnosti" class="col-form-label">Sifra delatnosti</label>
                            <input required type="text" class="form-control" id="sifraDelatnosti">
                        </div>
                        <div class="form-group">
                            <label for="maticniBroj" class="col-form-label">Maticni broj</label>
                            <input required type="text" class="form-control" id="maticniBroj">
                        </div>
                        <div class="form-group">
                            <label for="naziv" class="col-form-label">Naziv</label>
                            <input required type="text" class="form-control" id="naziv">
                        </div>
                        <div class="form-group">
                            <label for="brojTelefona" class="col-form-label">Broj telefona</label>
                            <input required type="text" class="form-control" id="brojTelefona">
                        </div>
                        <div class="form-group">
                            <label for="adresa" class="col-form-label">Adresa</label>
                            <input required type="text" class="form-control" id="adresa">
                        </div>
                        <div class="form-group">
                            <label for="grad" class="col-form-label">Grad</label>
                            <select required type="text" class="form-control" id="grad"></select>
                        </div>
                        <div class="form-group">
                            <label for="odgovornoLice" class="col-form-label">Odgovorno lice</label>
                            <input required type="text" class="form-control" id="odgovornoLice">
                        </div>
                        <div class="form-group">
                            <label for="tip" class="col-form-label">Tip preduzeca</label>
                            <select required type="text" class="form-control" id="tip"></select>
                        </div>

                        <button type="submit" class="btn btn-primary form-control">Sacuvaj</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div>
        <h1 class='text-center'>
            Preduzeca
        </h1>
    </div>
    <div class="d-flex justify-content-end">
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Kreiraj preduzece</button>
    </div>
    <div class="mt-4 mb-4">
        <input class="form-control" type="text" id='pretraga' placeholder="Pretrazi...">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Maticni broj</th>
                <th>Tip preduzeca</th>
                <th>Sifra delatnosti</th>
                <th>Broj telefona</th>
                <th>Adresa</th>
                <th>Grad</th>
                <th>Odgovorno lice</th>
                <th>Izmeni</th>
                <th>Obrisi</th>
            </tr>
        </thead>
        <tbody id='preduzeca'>

        </tbody>
    </table>
    <script src="./main.js"></script>
    <script>
        let id = 0;
        $(document).ready(function () {
            ucitajPreduzeca();
            ucitajSelect('server/grad.php?akcija=vratiSve', 'grad')
            ucitajSelect('server/tipPreduzeca.php?akcija=vratiSve', 'tip');
            $('#pretraga').change(function () {
                ucitajPreduzeca();
            });
            $('#forma').submit(function (e) {
                e.preventDefault();
                const naziv = $('#naziv').val();
                const sifraDelatnosti = $('#sifraDelatnosti').val();
                const maticniBroj = $('#maticniBroj').val();
                const tip = $('#tip').val();
                const brojTelefona = $('#brojTelefona').val();
                const adresa = $('#adresa').val();
                const odgovornoLice = $('#odgovornoLice').val();
                const grad = $('#grad').val();
                const telo = {
                    naziv,
                    sifraDelatnosti,
                    maticniBroj,
                    tip,
                    brojTelefona,
                    adresa,
                    odgovornoLice,
                    grad
                }
                if (id) {
                    $.post('server/preduzece.php?akcija=izmeni&id=' + id, telo, function (res) {
                        res = JSON.parse(res);
                        if (!res.status) {
                            alert(res.error);
                        } else {
                            alert("Uspesno izmenjeno preduzece");
                        }
                        ucitajPreduzeca();
                    })
                } else {
                    $.post('server/preduzece.php?akcija=kreiraj', telo, function (res) {
                        res = JSON.parse(res);
                        if (!res.status) {
                            alert(res.error);
                        } else {
                            alert("Uspesno kreirano preduzece");
                        }
                        ucitajPreduzeca();
                    })
                }
            })
            $('#exampleModal').on('show.bs.modal', function (e) {
                const button = $(e.relatedTarget);
                const selId = button.data('id');
                if (!selId) {
                    id = 0;
                    return;
                }
                id = selId;
                $('#naziv').val(button.data('naziv'))
                $('#maticniBroj').val(button.data('maticnibroj'))
                $('#sifraDelatnosti').val(button.data('sifradelatnosti'))
                $('#brojTelefona').val(button.data('brojtelefona'))
                $('#adresa').val(button.data('adresa'))
                $('#grad').val(button.data('grad'))
                $('#tip').val(button.data('tip'))
                $('#odgovornoLice').val(button.data('odgovornolice'))
            })
        })


        function ucitajPreduzeca() {
            ucitajUTabelu('server/preduzece.php?akcija=vratiSve', 'preduzeca', iscrtajPreduzece, filtrirajPreduzece)
        }
        function iscrtajPreduzece(element) {
            return `
                <tr>
                    <td>${element.id}</td>
                    <td>${element.naziv}</td>
                    <td>${element.maticniBroj}</td>
                    <td>${element.tip.naziv}</td>
                    <td>${element.sifraDelatnosti}</td>
                    <td>${element.brojTelefona}</td>
                    <td>${element.adresa}</td>
                    <td>${element.grad.naziv}</td>
                    <td>${element.odgovornoLice}</td>
                    <td>
                        <button data-toggle="modal" data-target="#exampleModal" 
                                data-id=${element.id}
                                data-naziv="${element.naziv}" 
                                data-maticniBroj="${element.maticniBroj}"
                                data-tip="${element.tip.id}" 
                                data-sifraDelatnosti="${element.sifraDelatnosti}"
                                data-brojTelefona="${element.brojTelefona}"
                                data-adresa="${element.adresa}"
                                data-grad="${element.grad.id}"
                                data-odgovornoLice="${element.odgovornoLice}"
                                class='btn btn-success form-control'>Izmeni</button>
                    </td>
                    <td>
                        <button onClick="obrisi(${element.id})" class='btn btn-danger form-control'>Obrisi</button>
                    </td>
                </tr>
            `
        }
        function filtrirajPreduzece(element) {
            const pretaraga = $('#pretraga').val();
            for (let key in element) {
                if (typeof element[key] !== 'object') {
                    if ((element[key] + '').toLocaleLowerCase().includes(pretaraga.toLocaleLowerCase())) {
                        return true;
                    }
                }

            }
            return false;
        }

        function obrisi(id) {
            $.post('server/preduzece.php?akcija=obrisi&id=' + id, function (res) {
                res = JSON.parse(res);
                if (!res.status) {
                    alert(res.error);
                } else {
                    alert("Uspesno obrisano preduzece");
                }
                ucitajPreduzeca();
            })
        }
    </script>
</div>
<?php
    include './layout/footer.php';
?>