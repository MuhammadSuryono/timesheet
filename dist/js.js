$(document).ready(function () {
    var i = 0;

    $(".addrow").on("click", function () {

        var ht = `<li>
                  <div class="row">

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="project` + i + `">Project/Program/Pekerjaan :</label>
                        <input type="text" class="form-control" id="project` + i + `" name="project` + i + `">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="deskripsi` + i + `">Keterangan :</label>
                        <input type="text" class="form-control" id="deskripsi` + i + `" name="deskripsi` + i + `">
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>Target Persentase</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="persentase` + i + `" name="persentase` + i + `" min="1" max="100">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fas fa-percent"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="">-</label>
                        <button class="ibtnDel btn-sm btn-danger" style="display:block;"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>

                  </div>
                </li>`

        $(".umum").append(ht);
        $("#jmlproject").attr('value', i);
        i++;

    })

});

$(".umum").on("click", ".ibtnDel", function (event) {
    $(this).closest("li").remove();
    i -= 1
});
