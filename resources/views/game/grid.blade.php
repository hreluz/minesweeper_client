<h2 class="text-center">Status: <span id="status_game" class="alert-info">Keep Playing</span> </h2>
<div class="container-fluid"> 
    <table class="table table-bordered"> 
        <thead> 
        </thead> 
        <tbody class="grid_table"> 
            @for( $i = 0 ; $i < $x ; $i++)
                <tr> 
                    @for( $j = 0; $j < $y ; $j++)
                        <td  id="x{{$i}}y{{$j}}" class="cell_click locked" data-flag="false" data-x="{{ $i }}" data-y="{{ $j }}">
                            &nbsp
                        </td>
                   @endfor
                </tr> 
            @endfor
        </tbody> 
    </table> 
</div>
