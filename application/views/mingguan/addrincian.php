<div class="form-group">
      <label>Pilih Rincian Pekerjaan</label>
      <!-- <input type="text" class="form-control" id="rincianmodal" name="rincianmodal" value="" required> -->
      <select class="form-control" name="rincianmodal" id="rincianmodal" required>
        <option value="" selected disabled>Pilih Rincian</option>
        <?php
        foreach ($rinciannya as $key) {
        ?>
        <option value="<?php echo $key['uraian']?>"><?php echo $key['uraian']?></option>
        <?php
        }
        ?>
      </select>
</div>
