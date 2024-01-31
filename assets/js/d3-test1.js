

fetch('/artists-and-events.json')
  .then(response => response.json())
  .then(data => {
    const svg = d3.select("svg");
    const width = +svg.attr("width");
    const height = +svg.attr("height");
  }
);

d3.json("/api/data").then(function(data) {
    const svg = d3.select("#visualization").append("svg")
                  .attr("width", 800)
                  .attr("height", 600);

    // Let's assume artists and events are placed randomly for simplicity
    // In a real application, you might want to calculate positions or use a layout algorithm
    const artists = data.artists.map((d, i) => ({
        ...d,
        x: Math.random() * 800,
        y: Math.random() * 600,
        type: 'artist'
    }));

    const events = data.events.map((d, i) => ({
        ...d,
        x: Math.random() * 800,
        y: Math.random() * 600,
        type: 'event'
    }));

    // Combine artist and event data for easier handling
    const nodes = artists.concat(events);

    // Create dots
    svg.selectAll(".dot")
       .data(nodes)
       .enter().append("circle")
       .attr("class", "dot")
       .attr("cx", d => d.x)
       .attr("cy", d => d.y)
       .attr("r", 5)
       .on("mouseover", function(event, d) {
            // On hover, show lines to connected nodes
            if(d.type === 'artist') {
                d.events.forEach(eventUuid => {
                    const eventNode = nodes.find(node => node.uuid === eventUuid);
                    svg.append("line")
                       .attr("class", "line")
                       .attr("x1", d.x)
                       .attr("y1", d.y)
                       .attr("x2", eventNode.x)
                       .attr("y2", eventNode.y)
                       .style("visibility", "visible");
                });
            } else {
                d.artists.forEach(artistUuid => {
                    const artistNode = nodes.find(node => node.uuid === artistUuid);
                    svg.append("line")
                       .attr("class", "line")
                       .attr("x1", d.x)
                       .attr("y1", d.y)
                       .attr("x2", artistNode.x)
                       .attr("y2", artistNode.y)
                       .style("visibility", "visible");
                });
            }
       })
       .on("mouseout", function() {
            // Hide lines when not hovering
            svg.selectAll(".line").remove();
       });
});