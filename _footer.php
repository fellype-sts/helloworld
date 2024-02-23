</main>
        <footer>
            <a href="index.php"><i class="fa-solid fa-house-chimney"></i></a>
            <div>
                <div>&copy; 2024 Eu mesmo.</div>
                <a href="privacy.php">Políticas de Privacidade</a>
            </div>
            <a href="#wrap"><i class="fa-solid fa-chevron-up"></i></a>
        </footer>
    </div>
    <script src="assets/js/global.js"></script>
    <script src="assets/js/<?php echo $page["js"] ?> "></script>

</body>

</html>
SELECT 
-- Get id, title, thumbnail, summary field
	art_id, art_date, art_thumbnail,art_title, art_summary
FROM article

-- Filters 
	WHERE
-- 	Get only recent or past articles
-- Don't get scheduled articles to future
	 art_date <= NOW()
     
-- Get only articles with status on
	AND art_status = 'on'
-- Ordered by most recent date
ORDER BY art_date DESC;