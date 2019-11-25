<footer id="footer">
    <small>&copy; copyright</small>
    <address><a href="mailto:test@examle.com"></a>mail@example.com</address>
</footer>
<script>
    $('[data-toggle="tooltip"]').hover(function() {
        $(this).tooltip({
            trigger: "hover",
            html: true,
            animation: false,
            content: $(this).prop("title").text
        }).tooltip('show');
    })</script>
</body>
</html>
