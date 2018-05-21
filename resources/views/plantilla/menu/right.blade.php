<?php 
    use App\Liga;
    $liga = new Liga();
    $ligas = $liga::select('id', 'nombre')->where('estado',1)->where('usuario_id', Auth::user()->id)->get();
?>
 <aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#skins" data-toggle="tab">Ligas</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="skins">
            <ul class="demo-choose-skin">
            </ul>
        </div>
    </div>
</aside>