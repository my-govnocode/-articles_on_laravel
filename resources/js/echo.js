Echo.private('article-change')
    .listen('.article-change', (e) => {
        alert("Изменения в статье " + e.articleTitle + "\n Было: " + e.articleOld + "\n Стало: " + e.articleNew + "\n Сcылка: " +  e.articleLink);
    });
