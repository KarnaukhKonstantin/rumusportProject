<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Authorization api user
Route::post('/register', 'Api\AuthController@register');
Route::post('/signup', 'Api\AuthController@signup');
Route::post('/login', 'Api\AuthController@login'); 

// Route::group(['middleware' => 'auth:api'], function() {
	//categories
	Route::get('/categories', 'API\Categories\CategoryController@getAllCategories');
	Route::get('/categories-without-pagination', 'API\Categories\CategoryController@categoriesWithoutPagination');
	Route::get('/categories/{category_id}', 'API\Categories\CategoryController@getCategory');
	Route::post('/categories', 'API\Categories\CategoryController@storeCategory');
	Route::put('/categories/{category_id}', 'API\Categories\CategoryController@updateCategory');
	Route::delete('/categories/{category_id}', 'API\Categories\CategoryController@deleteCategory');

	//tags
	Route::get('/tags', 'API\Tags\TagController@getAllTags');
	Route::get('/tags-without-paginate', 'API\Tags\TagController@getAllTagsWithoutPaginate');
	Route::get('/tags/{tag_id}', 'API\Tags\TagController@getTag');
	Route::post('/tags', 'API\Tags\TagController@storeTag');
	Route::put('/tags/{tag_id}', 'API\Tags\TagController@updateTag');
	Route::delete('/tags/{tag_id}', 'API\Tags\TagController@deleteTag');

	//nodes
	Route::get('/nodes', 'API\TagNodes\NodeController@allNodes');
	Route::get('/all-graph-lines-without-paginate', 'API\TagNodes\NodeController@graphsWithoutPaginate');
	Route::get('/all-graphs', 'API\TagNodes\NodeController@graphsAll');
	Route::post('/add-graph-line', 'API\TagNodes\NodeController@addGraphLineRelation');
	Route::put('/update-graph-line/{id}', 'API\TagNodes\NodeController@updateGraphLineRelation');
	Route::delete('/delete-graph-line/{id}', 'API\TagNodes\NodeController@deleteGraphLineRelation');

	//skills
	Route::get('/skills', 'API\Skills\SkillController@allSkills');
	Route::get('/allskills', 'API\Skills\SkillController@getSkills');
	Route::get('/skills/{skill_id}', 'API\Skills\SkillController@getSkill');
	Route::post('/skills', 'API\Skills\SkillController@storeSkill');
	Route::put('/skills/{skill_id}', 'API\Skills\SkillController@updateSkill');
	Route::delete('/skills/{skill_id}', 'API\Skills\SkillController@deleteSkill');

	//news
	Route::get('/news', 'API\News\NewsController@getAllNews');
	Route::get('/news/{article_id}', 'API\News\NewsController@getArticle');
	Route::get('/last-article', 'API\News\NewsController@getLastArticle');
	Route::post('/news', 'API\News\NewsController@storeArticle');
	Route::put('/news/{article_id}', 'API\News\NewsController@updateArticle');
	Route::delete('/news/{article_id}', 'API\News\NewsController@deleteArticle');

	//posts
	Route::get('/posts', 'API\Blog\PostController@getAllPosts');
	Route::get('/posts/{post_id}', 'API\Blog\PostController@getPost');
	Route::post('/posts', 'API\Blog\PostController@storePost');
	Route::put('/posts/{post_id}', 'API\Blog\PostController@updatePost');
	Route::delete('/posts/{post_id}', 'API\Blog\PostController@deletePost');
	Route::get('/main-posts', 'API\Blog\PostController@getMainPosts');

	//projects
	Route::get('/projects', 'API\Projects\ProjectController@getAllProjects');
	Route::get('/projects/without-paginate', 'API\Projects\ProjectController@getProjectsWithoutPaginate');
	Route::get('/projects/{project_id}', 'API\Projects\ProjectController@getProject');
	Route::post('/projects', 'API\Projects\ProjectController@storeProject');
	Route::put('/projects/{project_id}', 'API\Projects\ProjectController@updateProject');
	Route::delete('/projects/{project_id}', 'API\Projects\ProjectController@deleteProject');

	//about
	Route::get('/about-me', 'API\About\AboutController@getAuthorInfo');
	Route::get('/about', 'API\About\AboutController@getInfo');
	Route::post('/about', 'API\About\AboutController@storeInfo');
	Route::put('/about/{info_id}', 'API\About\AboutController@updateInfo');
	Route::delete('/about/{info_id}', 'API\About\AboutController@deleteInfo');

	//social links
	Route::get('/soclinks', 'API\SocialLinks\SocialLinkController@getAllSocLinks');
	Route::get('/soclinks-all', 'API\SocialLinks\SocialLinkController@getSocLinks');
	Route::get('/soclinks/{soclink_id}', 'API\SocialLinks\SocialLinkController@getSocLink');
	Route::post('/soclinks', 'API\SocialLinks\SocialLinkController@storeSocLink');
	Route::put('/soclinks/{soclink_id}', 'API\SocialLinks\SocialLinkController@updateSocLink');
	Route::delete('/soclinks/{soclink_id}', 'API\SocialLinks\SocialLinkController@deleteSocLink');

	//contact me
	Route::get('/messages', 'API\ContactMe\MessageController@getAllMessages');
	Route::post('/messages', 'API\ContactMe\MessageController@storeMessage');
	Route::delete('/messages/{id}', 'API\ContactMe\MessageController@deleteMessage');

	//image upload
	Route::post('/images/{type}','API\Files\ImageController@store');
	Route::post('/images/resize/{type}','API\Files\ImageController@storeResize');

	//Auth user
	Route::get('/userauth', 'API\Users\UserController@getAuthUser');
	Route::post('logout', 'API\AuthController@logout');

// });