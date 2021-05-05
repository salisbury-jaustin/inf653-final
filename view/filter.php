<main>
    <form class="filter" action="./index.php" method="get">
        <input type="hidden" name="action" value="sort"/>
        <div id="select_inputs">
            <select id="select_author" name="authorId">
                <option value="">
                    All Authors 
                </option>
                <?php foreach ($author_response->data as $author) :?>
                    <option value=<?php echo $author->id?>>
                        <?php echo $author->author;?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select id="select_category" name="categoryId">
                <option value="">
                    All Categories 
                </option>
                <?php foreach ($category_response->data as $category) :?>
                    <option value=<?php echo $category->id?>>
                        <?php echo $category->category;?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>