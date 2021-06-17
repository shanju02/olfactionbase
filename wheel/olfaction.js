const loadWheel = (data) => {
    const width = $(window).width()
    const height = $(window).height()
    const radius = width / 2

    const createSvg = () => {
        return  d3.select("svg#wheel")
            .style("width", "100%")
            .style("height", width)
            .style("background-color", "azure")
            .append("g")
            .attr("transform", "translate(" + radius + "," + radius + ")")
    }

    function createTree(olfactions) {
        let data = d3.hierarchy(olfactions).sort((a, b) => d3.ascending(a.data.name, b.data.name))

        const tree = d3.tree().size([2 * Math.PI, radius - 100])
        return tree(data)
    }

    const createPath = () => {
        return svg.append("g")
            .classed("path", true)
            .selectAll("path")
            .data(createLinks(data))
            .join("path")
            .attr("d", linkFunction())
    }

    const createLinks = (data) => {
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

        const rootLinkData = root.links()
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

    const linkFunction = () => {
        return d3.linkRadial().angle(d => d.x).radius(d => d.y)
    }

    const createNodes = () => {
        myNodes = svg.append("g")
            .selectAll("g")
            .data(root.descendants())
            .join("g")
            .attr("transform", d => `
                                        rotate(${d.x * 180 / Math.PI - 90})
                                        translate(${d.y},0)
                                      `)
            .on("mouseover", overed)
            .on("mouseout", outed)
            .on("click", nodeClickHandler)

        myNodes.append("circle")
            .attr("fill", d => '#' + d.data.color)
            .attr("r", d => d.data.children.length ? d.data.children.length : 2 )
            .classed("node", true)

        return myNodes
    }

    const createLabels = () => {
        circles
            .append("text")
            .classed("label", true)
            .attr("dy", "0.31em")
            .attr("x", d => d.x < Math.PI === !d.children ? 6 : -6)
            .attr("text-anchor", d => d.x < Math.PI === !d.children ? "start" : "end")
            .style("font-size", d => 12 + d.height * 3)

            .attr("transform", d => d.x >= Math.PI ? "rotate(180)" : null)
            .text(d => d.data.name)

        return myNodes
    }

    function overed(event, d) {

        d3.select(this)
            .transition()
            .duration('50')
            .attr('opacity', '.90')
            .attr("filter", false)

        const myPath = []
        do {
            console.log(d)
            myPath.push(d.x);
        } while ((d = d.parent));

        d3.selectAll("path")
            .classed("highlight", d => myPath.indexOf(d.source.x) > -1)

        svg.node().dispatchEvent(new CustomEvent("input"));
    }

    function outed() {
        d3.select(this)
            .transition()
            .duration('50')
            .attr('opacity', '1')

        d3.selectAll("path")
            .classed("highlight", false)
    }



    const olfactions = data.olfaction
    const networks = data.network

    const svg = createSvg()
    const root = createTree(olfactions)
    const path = createPath()
    const circles = createNodes()
    const labels = createLabels()


}

function nodeClickHandler(event, d) {
    console.log(d)
    $("#wheel").empty();
    loadWheel(d)
}
