document.addEventListener('DOMContentLoaded', function() {
    const svg = d3.select("svg"),
        width = +svg.attr("width"),
        height = +svg.attr("height");

    const artistLineY = height / 3, // Position of artist dots
          eventLineY = 2 * height / 3; // Position of event dots

    fetch('/assets/data/artists-and-events.json')
        .then(response => response.json())
        .then(data => {
            const artists = data;
            const eventsMap = new Map();

            // Flatten events and map them by UUID for easy access
            artists.forEach(artist => {
                artist.events.forEach(event => {
                    eventsMap.set(event.uuid, {...event, relatedArtists: []});
                });
            });

            // Associate artists with their events for line drawing
            artists.forEach(artist => {
                artist.events.forEach(event => {
                    const fullEvent = eventsMap.get(event.uuid);
                    if(fullEvent) fullEvent.relatedArtists.push(artist);
                });
            });

            const allEvents = Array.from(eventsMap.values());

            // Scale to distribute dots evenly
            const xScale = d3.scalePoint()
                             .domain(artists.map(d => d.uuid))
                             .range([0, width])
                             .padding(1);

            const xScaleEvents = d3.scalePoint()
                                   .domain(allEvents.map(d => d.uuid))
                                   .range([0, width])
                                   .padding(1);

            // Draw artist dots
            svg.selectAll(".artist-dot")
                .data(artists)
                .enter().append("circle")
                .attr("class", "artist-dot")
                .attr("cx", d => xScale(d.uuid))
                .attr("cy", artistLineY)
                .attr("r", 5)
                .attr("fill", "blue")
                .on("mouseover", function(event, d) {
                    // Highlight and connect to events on hover
                    drawLines(d);
                })
                .on("mouseout", function() {
                    // Remove lines when not hovering
                    removeLines();
                });

            // Draw event dots
            svg.selectAll(".event-dot")
                .data(allEvents)
                .enter().append("circle")
                .attr("class", "event-dot")
                .attr("cx", d => xScaleEvents(d.uuid))
                .attr("cy", eventLineY)
                .attr("r", 5)
                .attr("fill", "red");

            function drawLines(artist) {
                artist.events.forEach(event => {
                    const eventPos = eventsMap.get(event.uuid);
                    if(eventPos) {
                        svg.append("line")
                           .attr("class", "connection")
                           .attr("x1", xScale(artist.uuid))
                           .attr("y1", artistLineY)
                           .attr("x2", xScaleEvents(event.uuid))
                           .attr("y2", eventLineY)
                           .attr("stroke", "black");
                    }
                });
            }

            function removeLines() {
                svg.selectAll(".connection").remove();
            }
        });
});