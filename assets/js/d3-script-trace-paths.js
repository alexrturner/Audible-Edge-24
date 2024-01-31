document.addEventListener('DOMContentLoaded', function() {
    const svg = d3.select('svg.dynamic');
    const pathA = svg.append('path')
    .attr('id', 'pathA')                    
    .attr('d', 'M100,500 L200,100 L300,500')
    .attr('fill', 'none').attr('stroke', 'black');

    const pathE = svg.append('path')
                    .attr('id', 'pathE')
                    .attr('d', 'M500,100 L500,500 M500,100 L600,100 M500,300 L600,300 M500,500 L600,500')
                    .attr('fill', 'none')
                    .attr('stroke', 'black');

    fetch('/assets/data/artists-and-events.json')
        .then(response => response.json())
        .then(data => {
            const artists = data;
            const events = [];
            
            artists.forEach(artist => {
                artist.events.forEach(event => {
                    if (!events.some(e => e.uuid === event.uuid)) {
                        events.push(event);
                    }
                });
            });

            // Total lengths of the paths
            const totalLengthA = pathA.node().getTotalLength();
            const totalLengthE = pathE.node().getTotalLength();

            // Calculate spacing based on the number of artists and events
            const spacingA = totalLengthA / (artists.length - 1 || 1);
            const spacingE = totalLengthE / (events.length - 1 || 1);

            const eventPositions = new Map();

            // Place events along path E and store their positions
            events.forEach((event, index) => {
                const point = pathE.node().getPointAtLength(index * spacingE);
                eventPositions.set(event.uuid, point);
                svg.append('circle')
                    .attr('cx', point.x)
                    .attr('cy', point.y)
                    .attr('r', 5)
                    .attr('fill', 'red');
            });

            // Place artists along path A and add hover interactivity
            artists.forEach((artist, index) => {
                const pointA = pathA.node().getPointAtLength(index * spacingA); // Define pointA for artist
                svg.append('circle')
                    .attr('cx', pointA.x)
                    .attr('cy', pointA.y)
                    .attr('r', 5)
                    .attr('fill', 'blue')
                    .on('mouseover', function() {
                        // Ensure 'point' is correctly scoped and refers to the artist's position
                        drawLines(artist, pointA); // Pass pointA here
                    })
                    .on('mouseout', removeLines);
            });

            function drawLines(artist, pointA) { // Adjust to receive pointA
                artist.events.forEach(event => {
                    const eventPoint = eventPositions.get(event.uuid);
                    if (eventPoint) {
                        svg.append('line')
                        .attr('class', 'connection')
                        .attr('x1', pointA.x) // Use pointA.x here
                        .attr('y1', pointA.y) // Use pointA.y here
                        .attr('x2', eventPoint.x)
                        .attr('y2', eventPoint.y)
                        .attr('stroke', 'black')
                        .attr('stroke-width', 1);
                    }
                });
            }

            function removeLines() {
                svg.selectAll('.connection').remove();
            }
        });

        d3.selectAll('.artist-element')
        .on('mouseover', function() {
            d3.select('.logo-svg-path') // Select the logo's path
            .transition() // Smooth transition
            .duration(500) // Duration in milliseconds
                // Example: modify path data for a wave effect
            .attr('d', 'modified path data here');
        })
        .on('mouseout', function() {
            // Revert logo to original state
            d3.select('.logo-svg-path')
            .transition() // Smooth transition
            .duration(500) // Duration in milliseconds
            .attr('d', 'original path data here');
        });
});
