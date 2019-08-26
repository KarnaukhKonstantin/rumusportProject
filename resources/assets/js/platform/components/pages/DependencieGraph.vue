<template>
	<section>
		<div :style="{ width: (width-2) + 'px', height: (height-2) + 'px', border: '1px solid black' }">
			<svg width="100%" height="100%">
				<defs>
					<pattern id="innerGrid" :width="innerGridSize" :height="innerGridSize" patternUnits="userSpaceOnUse">
						<rect width="100%" height="100%" fill="none" stroke="#CCCCCC7A" stroke-width="0.5"/>
					</pattern>
					<pattern id="grid" :width="gridSize" :height="gridSize" patternUnits="userSpaceOnUse">
						<rect width="100%" height="100%" fill="url(#innerGrid)" stroke="#CCCCCC7A" stroke-width="1.5"/>
					</pattern>
				</defs>
			</svg>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				
				width: 1024,
				height: 768,
				gridSize: 100,
				selections: {},
				simulation: null,
				forceProperties: {
					center: {
						x: 0.5,
						y: 0.5
					},
					charge: {
						enabled: true,
						strength: -700,
						distanceMin: 1,
						distanceMax: 2000
					},
					collide: {
						enabled: true,
						strength: .7,
						iterations: 1,
						radius: 35
					},
					forceX: {
						enabled: true,
						strength: 0.05,
						x: 0.5
					},
					forceY: {
						enabled: true,
						strength: 0.35,
						y: 0.5
					},
					link: {
						enabled: true,
						distance: 100,
						iterations: 1
					}
				},
				data: {
					nodes: [
				    { "name": "firmware",               "group":  1, "class": "system" },
				    { "name": "loader",                 "group":  1, "class": "system" },
				    { "name": "kernel",                 "group":  1, "class": "system" },
				    { "name": "systemd",                "group":  1, "class": "mount" },
				    { "name": "-.mount",                "group":  1, "class": "mount" },
				    { "name": "init.scope",             "group":  1, "class": "init" },
				    { "name": "system.slice",           "group":  1, "class": "init" },
				    { "name": "system-getty.slice",     "group":  1, "class": "init" },
				    { "name": "systemd-initctl.socker", "group":  1, "class": "init" },
				    { "name": "tmp.mount",              "group":  1, "class": "init" },
				    { "name": "sys-devices",            "group":  2, "class": "init" },
				    { "name": "boot.mount",             "group":  2, "class": "init" }
				  ],
				links: [
				    { "source":  1,  "target":  0,  "value":  1, "type": "depends" },
				    { "source":  2,  "target":  1,  "value":  8, "type": "depends" },
				    { "source":  3,  "target":  2,  "value":  6, "type": "depends" },
				    { "source":  4,  "target":  3,  "value":  1, "type": "needs" },
				    { "source":  5,  "target":  3,  "value":  1, "type": "needs" },
				    { "source":  6,  "target":  3,  "value":  1, "type": "needs" },
				    { "source":  7,  "target":  3,  "value":  1, "type": "needs" },
				    { "source":  8,  "target":  3,  "value":  2, "type": "needs" },
				    { "source":  9,  "target":  3,  "value":  1, "type": "needs" },
				    { "source": 11,  "target": 10,  "value":  1, "type": "depends" },
				    { "source": 11,  "target":  3,  "value":  3, "type": "depends" },
				    { "source": 11,  "target":  2,  "value":  3, "type": "depends" },
				    { "source": 11,  "target":  3,  "value":  5, "type": "needs" }
				  ]
				},
			}
		},
		computed: {
			innerGridSize() { return this.gridSize / 10 },
			nodes() { return this.data.nodes },
			links() { return this.data.links },
		},
		created() {
		      // You can set the component width and height in any way
		      // you prefer. It's responsive! :)
		      this.width = window.innerWidth
		      this.height = window.innerHeight

		      this.simulation = d3.forceSimulation()
		      .force("link", d3.forceLink())
		      .force("charge", d3.forceManyBody())
		      .force("collide", d3.forceCollide())
		      .force("center", d3.forceCenter())
		      .force("forceX", d3.forceX())
		      .force("forceY", d3.forceY())
		      .on("tick", this.tick)
		      // Call first time to setup default values
		      this.updateForces()
		 },
		 mounted() {
		  	this.selections.svg = d3.select(this.$el.querySelector("svg"))
		  	const svg = this.selections.svg

	      // Add zoom and panning triggers
	      this.zoom = d3.zoom()
	      .scaleExtent([1 / 4, 4])
	      .on('zoom', this.zoomed)
	      svg.call(this.zoom)

	      // A background grid to help user experience
	      // The width and height depends on the minimum scale extent and
	      // the + 10% and negative index to create an infinite grid feel
	      // The precedence of this element is important since you'll have
	      // click events on the elements above the grid
	      this.selections.grid = svg.append('rect')
	      .attr('x', '-10%')
	      .attr('y', '-10%')
	      .attr('width', '410%')
	      .attr('height', '410%')
	      .attr('fill', 'url(#grid)');

	      this.selections.graph = this.selections.svg.append("g")
	      const graph = this.selections.graph


	      // You can set data in any ways you want
	      d3.json("data.json").then(data => {
	      	this.data = data
	      }).catch(error => {
	      	console.error('Cannot proceed with simulation, failed to  retrieve data.')
	      });
  		},
  		 methods: {
      tick() {
        const transform = d => {
          return "translate(" + d.x + "," + d.y + ")";
        }

        const link = d => {
          return "M" + d.source.x + "," + d.source.y + " L" + d.target.x + "," + d.target.y;
        }

        const graph = this.selections.graph
        graph.selectAll("path").attr("d", link)
        graph.selectAll("circle").attr("transform", transform)
        graph.selectAll("text").attr("transform", transform)
      },
      updateData() {
        this.simulation.nodes(this.nodes)
        this.simulation.force("link").links(this.links)

        const simulation = this.simulation
        const graph = this.selections.graph

        graph.selectAll("path")
          .data(simulation.force("link").links())
        .enter().append("path")
          .attr("class", d => "link " + d.type)
        .exit().remove()

        graph.selectAll("circle")
          .data(simulation.nodes())
        .enter().append("circle")
          .attr("r", 30)
          .attr("class", d => d.class)
          .call(d3.drag()
            .on('start', this.nodeDragStarted)
            .on('drag', this.nodeDragged)
            .on('end', this.nodeDragEnded))
        .exit().remove()

        graph.selectAll("text")
          .data(simulation.nodes())
        .enter().append("text")
          .attr("x", 0)
          .attr("y", ".31em")
          .attr("text-anchor", "middle")
          .text(d => d.name)

        simulation.alpha(1).restart();
      },
      updateForces() {
        const { simulation, forceProperties, width, height } = this
        simulation.force("center")
        .x(width * forceProperties.center.x)
        .y(height * forceProperties.center.y);
        simulation.force("charge")
          .strength(forceProperties.charge.strength * forceProperties.charge.enabled)
          .distanceMin(forceProperties.charge.distanceMin)
          .distanceMax(forceProperties.charge.distanceMax);
        simulation.force("collide")
          .strength(forceProperties.collide.strength * forceProperties.collide.enabled)
          .radius(forceProperties.collide.radius)
          .iterations(forceProperties.collide.iterations);
        simulation.force("forceX")
          .strength(forceProperties.forceX.strength * forceProperties.forceX.enabled)
          .x(width * forceProperties.forceX.x);
        simulation.force("forceY")
          .strength(forceProperties.forceY.strength * forceProperties.forceY.enabled)
          .y(height * forceProperties.forceY.y);
        simulation.force("link")
          .distance(forceProperties.link.distance)
          .iterations(forceProperties.link.iterations);

        // updates ignored until this is run
        // restarts the simulation (important if simulation has already slowed down)
        simulation.alpha(1).restart();
      },
      zoomed() {
        const transform = d3.event.transform;
        // The trick here is to move the grid in a way that the user doesn't perceive
        // that the axis aren't really moving
        // The actual movement is between 0 and gridSize only for x and y
        const translate = transform.x % (this.gridSize * transform.k) + ',' +
          transform.y % (this.gridSize * transform.k)
        this.selections.grid.attr('transform', 'translate(' +
          translate + ') scale(' + transform.k + ')');
        this.selections.graph.attr('transform', transform)

        // Define some world boundaries based on the graph total size
        // so we don't scroll indefinitely
        const graphBox = this.selections.graph.node().getBBox()
        const margin = 200
        const worldTopLeft = [graphBox.x - margin, graphBox.y - margin]
        const worldBottomRight = [
          graphBox.x + graphBox.width + margin,
          graphBox.y + graphBox.height + margin
        ]
        this.zoom.translateExtent([worldTopLeft, worldBottomRight])
      },
      nodeDragStarted(d) {
        if (!d3.event.active) { this.simulation.alphaTarget(0.3).restart(); }
        d.fx = d.x;
        d.fy = d.y;
      },
      nodeDragged(d) {
        d.fx = d3.event.x;
        d.fy = d3.event.y;
      },
      nodeDragEnded(d) {
        if (!d3.event.active) { this.simulation.alphaTarget(0.0001); }
        d.fx = null;
        d.fy = null;
      }
    },
    watch: {
      data: {
        handler(newData) {
          this.updateData()
        },
        deep: true
      },
      forceProperties: {
        handler(newForce) {
          this.updateForces()
        },
        deep: true
      }
    }
}	

</script>
<style>
  path.link {
    fill: none;
    stroke: #666;
    stroke-width: 1.5px;
  }
  path.link.depends {
    stroke: #005900;
    stroke-dasharray: 5, 2;
  }
  path.link.needs {
    stroke: #7f3f00;
  }

  circle {
    fill: #ffff99;
    stroke: #191900;
    stroke-width: 1.5px;
  }
  circle.system {
    fill: #cce5ff;
    stroke: #003366;
  }
  circle.mount {
    fill: #ffe5e5;
    stroke: #660000;
  }
  circle.init {
    fill: #b2e8b2;
    stroke: #001900;
  }

  text {
    font: 10px sans-serif;
    pointer-events: none;
    text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
  }
  </style>