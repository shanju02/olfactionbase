@extends('layouts.frontend')

@section('page-title', 'Publication')

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Publications</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12">
                    <p>
                        1. Anju Sharma, Rajnish Kumar, Pritish Varadwaj. Smelling the Disease: Diagnostic Potential of
                        Breath Analysis. Mol Diagn Ther 2023, 27, 321–347
                    </p>
                    <p>
                        2. Anju Sharma, Rajnish Kumar, Pritish Varadwaj. Developing human olfactory network and
                        exploring olfactory receptor-odorant interaction. J Biomol Struct Dyn., 2023, 41 (18);
                        8941-8960.
                    </p>
                    <p>
                        3. Anju Sharma, Rajnish Kumar, Pritish Varadwaj. Decoding seven basic odors by investigating
                        pharmacophores and molecular features of odorants. Current Bioinformatics. 2022, 17(8), 759-774.
                    </p>
                    <p>
                        4. Anju Sharma, Rajnish Kumar, Rahul Semwal, Imlimaong Aier, Pankaj Tyagi and Pritish Varadwaj.
                        DeepOlf: Deep neural network-based architecture for predicting odorants and their interacting
                        Olfactory Receptors. IEEE/ACM Transactions on Computational Biology and Bioinformatics. 2022,
                        19(1), 418–428.
                    </p>
                    <p>
                        5. Anju Sharma, Bishal Saha, Rajnish Kumar, Pritish Varadwaj. OlfactionBase: a repository to
                        explore odors, odorants, olfactory receptors, and odorant-receptor interactions. Nucleic Acids
                        Research.2022, 50(D1), D678–D686.
                    </p>
                    <p>
                        6. Anju Sharma, Rajnish Kumar, Pritish Varadwaj. OBPred: feature-fusion-based deep neural
                        network classifier for odorant-binding protein prediction. Neural Computing & Applications,
                        2021, 33, 17633–17646.
                    </p>
                    <p>
                        7. Anju Sharma, Rajnish Kumar, Shabnam Ranjta and Pritish Varadwaj. SMILES to Smell: Decoding
                        the Structure–Odor Relationship of Chemical Compounds Using the Deep Neural Network Approach. J.
                        Chem. Inf. Model. 2021, 61(2), 676–688.
                    </p>
                    <p>
                        8. Anju Sharma, Rajnish Kumar, Imlimaong Aier, Rahul Semwal, Pankaj Tyagi, Pritish Kumar
                        Varadwaj. Sense of Smell: Structural, Functional, Mechanistic Advancements and Challenges in
                        Human Olfactory Research. Current Neuropharmacology. 2019, 17(9), 891 911.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="section-title mt-3" data-aos="fade-up">
                <h2>On Odorants & Odorless compounds webpage</h2>
            </div>
            <div class="row content">
                <div class="col-lg-12">
                    <p>
                        If I select Odor: Balsamic and Subodor: Balsamic and search
                    </p>
                    <p>
                        There are 255 entries. From 51 entries onwards, for all compounds till 255 #odors column (second
                        last column) has entries 0.
                    </p>
                    <p>
                        Example: 7-Methoxycoumarin (Sr. No 51) has zero in #Odors column. If it is listed in search
                        output table when searched for Balsamic odor, minimum 1 should be there in #odors and
                        corresponding webapge (View) should also have same information
                    </p>
                    <p>
                        When I am searching the same chemical (7-Methoxycoumarin) using its SMILES
                        (COC1=CC2=C(C=C1)C=CC(=O)O2) in substructure field, the search table now has 3 in #odors column
                        and View option also shows 3 odors in respective chemical page
                    </p>
                    <p>
                        Conclusion: When searching using odor and subodor option, #odor column is not giving correct
                        values usually zero for some (not all) chemicals, but when a specific chemical which is listed
                        as #odors 0 is searched using its SMILES (substructure) the #odors value 0 is replaced with
                        actual number of odors and View option reflects correct page.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
@endpush

@push('footer')
@endpush

