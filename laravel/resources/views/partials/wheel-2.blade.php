<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <svg id="wheel">
            </svg>
            <div id="my_tooltip"></div>
        </div>
    </div>
</div>

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
        function loadWheel(svg, data, root) {
            function createPath() {
                return svg.append("g")
                    .classed("path", true)
                    .selectAll("path")
                    .data(createLinks(data))
                    .join("path")
                    .attr("d", linkFunction())
            }

            function createLinks(data) {
                let multiPars = []

                data.network.forEach(d => {
                    multiPars.push({
                        parent: root.descendants().filter(n => {
                            return n.data.id === d.source
                        })[0],
                        child: root.descendants().filter(m => {
                            return m.data.id === d.target
                        })[0]
                    })
                })

                let rootLinkData = root.links()
                let linkData = []
                rootLinkData.forEach(d => {
                    if (d.target.depth < 4) {
                        linkData.push(d)
                    }
                })

                multiPars.forEach( d => {
                    let oTarget = {
                        x: d.parent.x,
                        y: d.parent.y
                    };
                    let oSource = {
                        x: d.child.x,
                        y: d.child.y
                    };

                    if (d.child.depth < 4) {
                        linkData.push({
                            source: oSource,
                            target: oTarget
                        })
                    }

                })

                return linkData
            }

            function linkFunction() {
                return d3.linkRadial().angle(d => d.x).radius(d => d.y)
            }

            let tooltip = d3.select("#my_tooltip")
                .append("div")
                .text("a simple tooltip")
                .classed("my-tooltip", true)


            function overed(event, d) {
              tooltip.style("visibility", "visible")

              d3.selectAll("path")
                .classed("highlight", path => {
                  if ( (path.source.x === d.x && path.source.y === d.y) || (path.target.x === d.x && path.target.y === d.y)) {
                    return true
                  }
                }
              )
            }

            function outed() {
                tooltip.style("visibility", "hidden")

                d3.select(this)
                    .transition()
                    .duration('50')
                    .attr('opacity', '1')

                d3.selectAll("path")
                    .classed("highlight", false)
            }

            function moved(event, d) {
                tooltip.text(d.data.name)
                    .style("top", (event.pageY-50)+"px")
                    .style("left",(event.pageX-20)+"px")
            }

            function createNodes() {
                let myNodes = svg.append("g")
                    .selectAll("g")
                    .data(root.descendants())
                    .join("g")

                    .attr("transform", d => `
                                        rotate(${d.x * 180 / Math.PI - 90})
                                        translate(${d.y},0)
                                      `)
                    .on("mouseover", overed)
                    .on("mousemove", moved)
                    .on("mouseout", outed)
                    .on("click", nodeSingleClickHandler)
                    .on("dblclick", nodeDoubleClickHandler)

                myNodes.append("circle")
                    .attr("fill", d => '#' + d.data.color)
                    .attr("r", d => d.depth < 3 ? 5 : 2 )
                    .classed("node", true)

                myNodes
                    .append("text")
                    .classed("label", true)
                    .attr("dy", "0.31em")
                    .attr("x", d => d.x < Math.PI === !d.children ? 6 : -6)
                    .attr("text-anchor", d => d.x < Math.PI === !d.children ? "start" : "end")
                    .attr("transform", d => d.x >= Math.PI ? "rotate(180)" : null)
                    .style("font-size", d => d.depth < 3 ? 14 : 12)
                    .text(d => d.data.name)
            }

            createPath()
            createNodes()

            let timer = 0;
            const delay = 200;
            let prevent = false;

            function nodeSingleClickHandler(event, d) {
              if (d.data.type !== 'root' && d.data.type !== 'odorant') {
                timer = setTimeout(function() {
                  if (!prevent) {

                    showNestedTree(d)
                  }
                  prevent = false;
                }, delay)
              } else {
                window.location.href = "{{ route('olfaction.wheel') }}"
              }
            }

            function nodeDoubleClickHandler(event, d) {
                clearTimeout(timer);
                prevent = true;

                redirectToDetails(d)
            }

            async function showNestedTree(d) {
              tooltip.style("visibility", "hidden")
              const svg = d3.select("svg#wheel")
              svg.selectAll("*").remove()

              d3.json("{{ config('app.url') }}" + '/nested/'+d.data.type+'/'+ d.data.page).then((newData) => {
                const width = $(window).width()
                const height = 1000
                  const radius = width / 2
                  const olfactions = newData.olfaction
                  const networks = newData.network

                svg.style("width", width)
                    .style("height", height)
                    .attr("viewBox", "0 -500 100 1000")
                    .append("g")


                  const hierarchy = d3.hierarchy(olfactions).sort((a, b) => d3.ascending(a.data.name, b.data.name))
                  const tree = d3.tree().size([2 * Math.PI, 400])
                  let root = tree(hierarchy)

                  loadWheel(svg, newData, root)
                })
            }

            function redirectToDetails(d) {
                let redirectTo = false
                let redirectToUrl = "{{ config('app.url') }}"

                switch (d.data.type) {
                    case 'odor':
                        redirectToUrl += "/odor?odor="+d.data.page
                        redirectTo = true
                        break
                    case 'sub-odor':
                        redirectToUrl += "/odor?odor="+d.parent.data.page+"&subodor="+d.data.page
                        redirectTo = true
                        break
                    case 'odorant':
                        redirectToUrl += "/chemical/"+d.data.page
                        redirectTo = true
                        break
                    default:
                }

                if (redirectTo) {
                    window.location.href = redirectToUrl
                }
            }
        }
        $(document).ready(function() {
            d3.json("{{ asset('wheel/olfaction.json') }}")
                .then((data) => {
                    const width = $(window).width()
                    const height = $(window).height()
                    const radius = width / 2
                    const olfactions = data.olfaction
                    const networks = data.network

                    const svg = d3.select("svg#wheel")
                        .style("width", "100%")
                        .style("height", width)
                        .style("background-color", "azure")
                        .append("g")
                        .attr("transform", "translate(" + radius + "," + radius + ")")

                    const hierarchy = d3.hierarchy(olfactions).sort((a, b) => d3.ascending(a.data.name, b.data.name))
                    const tree = d3.tree().size([2 * Math.PI, radius - 100])
                    let root = tree(hierarchy)

                    loadWheel(svg, data, root)
                })
                .catch((error) => {
                    console.log(error)
                })
        })


    </script>
@endpush
