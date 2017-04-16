<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        getVideoYoutube(4, 1);
    });

    function getVideoYoutube(max_results, start_index) {
        var url = "http://gdata.youtube.com/feeds/api/playlists/PL4lAcpf5UF8hiPR49HW_5XkqiuwAA8nOX?alt=json";

        $.ajax({
            url: url,
            data: {
                "max-results": max_results,
                "start-index": start_index,
            },
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var feed = data.feed;
                var entries = feed.entry || [];

                for (i = 0; i < entries.length; i++) {
                    var entry = entries[i];

                    var title = entry.title.$t;
                    var image = entry.media$group.media$thumbnail[0].url;
                    var url_video = entry.link[0].href;
                    var html_video = '';

                    html_video += '<li><a href="' + url_video + '" title="Assistir v&aacute;deo ' + title + '" target="_blank">';
                    html_video += '<img src="' + image + '" alt="Video ' + title + '" width="200"/>';
                    html_video += '<p>' + title + '</p>';
                    html_video += '</a></li>';

                    $("#listaVideos").append(html_video);
                }
            }
        });

    }

</script>