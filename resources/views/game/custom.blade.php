
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Custom Minesweeper</h4>
      </div>

      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Number rows</label>
            <input type="email" class="form-control" id="number_rows" placeholder="Number rows">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Number columns</label>
            <input type="email" class="form-control" id="number_columns" placeholder="Number columns">
        </div>  
        <div class="form-group">
            <label for="exampleInputEmail1">Number mines</label>
            <input type="email" class="form-control" id="number_mines" placeholder="Number mines">
        </div>  
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary start_game"  data-level="custom">Play</button>
      </div>
    </div>
  </div>
</div>