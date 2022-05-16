<section
    id="hero"
    class="d-flex align-items-center"
    style="height: 100%; margin-top: 30px; padding: 60px 0 30px 0">

    <div class="container">
        <div class="row">
            <div class="col-lg-7 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">OlfactionBase</h1>
                <h2 class="text-start" data-aos="fade-up" data-aos-delay="400" style="margin-bottom: 25px">A repository
                    of Odors, Odorants, Olfactory Receptors and related information</h2>

                <div class="alert alert-primary" role="alert">
                    Sharma A, Saha BK, Kumar R, Varadwaj PK. OlfactionBase: a repository to explore odors, odorants,
                    olfactory receptors and odorant-receptor interactions. Nucleic Acids Res. 2022 Jan
                    7;50(D1):D678-D686. doi: 10.1093/nar/gkab763.
                </div>

                <div data-aos="fade-up" data-aos-delay="800">
                    <p>OlfactionBase is a manually-curated comprehensive database that incorporates multidimensional
                        facets of major components involved in the olfaction process, i.e., odors, chemicals (both
                        odorants and odourless), Olfactory Receptors (ORs), odorant-OR interaction, and other associated
                        proteins (odorant-binding proteins (OBPs), pheromone binding proteins (PBPs), and chemosensory
                        proteins). OlfactionBase collates information from different resources. OlfactionBase offers
                        several navigation and data retrieval options like Olfaction Wheel and interlinked textual and
                        drawing based (for chemical structure) search options.</p>
                    <p>The Olfaction Wheel allows the user to browse through the odor classifications interactively,
                        backward and forward, to access corresponding odorant molecules, odorant's chemical profile and
                        interacting ORs.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="800">
                    <a href="{{ route('olfaction.wheel') }}" class="btn-get-started scrollto">Olfaction Wheel</a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                <a href="{{ route('olfaction.wheel') }}">
                    <img src="{{ asset('assets/img/wheel.png') }}" class="img-fluid" alt="">
                </a>
            </div>
        </div>
    </div>

</section>
