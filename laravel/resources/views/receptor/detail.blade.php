@extends('layouts.frontend')

@section('page-title', $receptor->name)

@section('content')
    @include('partials.breadcrumb')
    <section class="inner-page">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>{{ $receptor->name }}</h2>
            </div>

            <div class="row">
                <div class="col-md-4">
                    @include('receptor.partials.graph')
                </div>
                <div class="col-lg-4">
                    @include('receptor.partials.odorant-or-pairs')
                </div>
                <div class="col-lg-4">
                    @include('receptor.partials.general-information')
                    @include('receptor.partials.cross-references')
                </div>
            </div>
            <div class="row content mt-3">
                <div class="col-lg-12">
                    @include('receptor.partials.nucleotide-seq')
                </div>
            </div>
            <div class="row content mt-3">
                <div class="col-lg-12">
                    @include('receptor.partials.protein-seq')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header')
    <style>
        .path {
            fill: none;
            stroke: #56c2a3;
            stroke-opacity: 0.4;
            stroke-width: 1.5;
        }
        .label {
            text-shadow:
                    -1px -1px 3px white,
                    -1px  1px 3px white,
                    1px -1px 3px white,
                    1px  1px 3px white;
            pointer-events: none;
            font-family: 'Playfair Display', serif;
            font-size: 16px;
        }
        .label:hover {
            cursor: pointer;
            font-size: 22px !important;
        }
        .node {
            cursor: pointer;
        }
        .node:hover {
            filter: none;
        }
        path.highlight {
            stroke: #f4511e;
            stroke-opacity: 1;
            stroke-width: 4;
            stroke-dasharray: 4px;
            stroke-dashoffset: 8px;
            animation: stroke 0.2s linear infinite;
        }

        @keyframes stroke {
            to {
                stroke-dashoffset: 0;
            }
        }

        .my-tooltip {
            visibility: hidden;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 9999;
            transition: opacity 0.3s;
        }

        .my-tooltip::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

    </style>
@endpush

@push('footer')
    <script>
      const width = 400
      const radius = width / 2
      const data = {!! $odorantsJson !!}
          const hierarchy = d3.hierarchy(data).sort((a, b) => d3.ascending(a.data.name, b.data.name))
      const tree = d3.tree().size([2 * Math.PI, radius - 100])
      let root = tree(hierarchy)

      const svg = d3.select("svg#graph")
      .style("width", "100%")
      .style("height", width)
      .style("background-color", "azure")
      .append("g")
      .attr("transform", "translate(" + radius + "," + radius + ")")

      svg.append("g")
      .classed("path", true)
      .selectAll("path")
      .data(root.links())
      .join("path")
      .attr("d", d3.linkRadial().angle(d => d.x).radius(d => d.y))

      svg.append("g")
      .selectAll("g")
      .data(root.descendants())
      .join("g")
      .attr("transform", d => `
                                        rotate(${d.x * 180 / Math.PI - 90})
                                        translate(${d.y},0)
                                      `)
      .append("circle")
      .attr("fill", "#3498db")
      .attr("r", 8 )
      .classed("node", true)
      .on("click", nodeClickHandler)

      svg.append("g")
      .attr("font-family", "sans-serif")
      .attr("font-size", 14)
      .attr("stroke-linejoin", "round")
      .attr("stroke-width", 3)
      .selectAll("text")
      .data(root.descendants())
      .join("text")
      .on("click", nodeClickHandler)
      .style('cursor', 'pointer')
      .attr("transform", d => `
          rotate(${d.x * 180 / Math.PI - 90})
          translate(${d.y},0)
          rotate(${d.x >= Math.PI ? 180 : 0})
        `)
      .attr("dy", "0.31em")
      .attr("x", d => d.x < Math.PI === !d.children ? 16 : -16)
      .attr("text-anchor", d => d.x < Math.PI === !d.children ? "start" : "end")
      .text(d => d.data.name)
      .clone(true).lower()
      .attr("stroke", "white");

      function nodeClickHandler(event, d) {
        clearTimeout(0);

        if (d.parent !== null) {
          let redirectToUrl = "{{ route('index') }}" + "/chemical/"+d.data.id
          window.location.href = redirectToUrl
        }
      }
    </script>
@endpush

