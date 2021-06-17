<div class="card mt-5" style="background-color: #F5F5F5;">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-4">
                <a href="{{ asset('assets/structures/chemicals/'.$odorant->image) }}" download>Image</a>
            </div>
            <div class="col-lg-4">
                <a href="{{ asset('assets/structures/2d/'.$odorant->structure_2d) }}" download>2D Structure</a>
            </div>
            <div class="col-lg-4">
                <a href="{{ asset('assets/structures/3d/'.$odorant->structure_3d) }}" download>3D Conformer</a>
            </div>
        </div>
    </div>
    <div class="card-body text-center">
        <div style="height: 400px">
            <img src="{{ asset('assets/structures/chemicals/'.$odorant->image) }}" class="img-fluid" alt="image of chemical">
            <div class="mt-2">&nbsp;</div>

        </div>
    </div>
</div>
