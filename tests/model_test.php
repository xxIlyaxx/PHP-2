<?php

require __DIR__ . '/../autoload.php';

use App\Models\Article;

//Test Article::findAll()
assert(Article::findAll()[0] instanceof Article);
var_dump(Article::findAll());


//Test Article::findById()
assert(Article::findById(1) instanceof Article);
assert(false == Article::findById(-10));
assert(1 == Article::findById(1)->id);
var_dump(Article::findById(1));


//Test Article::findLast()
assert(Article::findLast()[0] instanceof Article);
assert(3 == count(Article::findLast()));
assert(2 == count(Article::findLast(2)));
assert([] == Article::findLast(0));
var_dump(Article::findLast());
