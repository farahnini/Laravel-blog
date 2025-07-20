<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $editors = User::role('editor')->get();
        $editorIds = $editors->pluck('id')->all();

        Article::create([
            'title' => "A Beginner’s Guide to Laravel: Building Your First Web App",
            'content' => '
                <h2>Introduction</h2>
                <p>Laravel is one of the most popular PHP frameworks for web development. Its elegant syntax and powerful features make it a favorite among developers. In this guide, we’ll walk you through building your first Laravel web application from scratch.</p>
                <h3>Step 1: Installing Laravel</h3>
                <p>To get started, you’ll need Composer installed on your machine. Then run:</p>
                <pre><code>composer create-project laravel/laravel myApp</code></pre>
                <h3>Step 2: Setting Up the Database</h3>
                <ul>
                    <li>Configure your <code>.env</code> file with your database credentials.</li>
                    <li>Run <code>php artisan migrate</code> to create the default tables.</li>
                </ul>
                <h3>Step 3: Creating Your First Model and Controller</h3>
                <p>Let’s create a simple <strong>Post</strong> model:</p>
                <pre><code>php artisan make:model Post -mcr</code></pre>
                <p>This command creates a model, migration, and controller for posts.</p>
                <h3>Adding an Image</h3>
                <p>Here’s an example of a beautiful Unsplash image:</p>
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Laptop" style="max-width:100%;border-radius:8px;">
                <h3>Conclusion</h3>
                <p>With these basics, you’re ready to start building powerful web apps with Laravel. For more, check out the <a href="https://laravel.com/docs">official documentation</a>.</p>
                <h3>Further Reading</h3>
                <ul>
                    <li><a href="https://laracasts.com">Laracasts</a> for video tutorials</li>
                    <li><a href="https://laravel-news.com">Laravel News</a> for community updates</li>
                </ul>
                <p>' . str_repeat('Laravel makes PHP fun and productive. ', 30) . '</p>
            ',
            'user_id' => $editorIds[array_rand($editorIds)],
        ]);

        Article::create([
            'title' => "How to Write Engaging Blog Posts: Tips from the Pros",
            'content' => '
                <h2>Introduction</h2>
                <p>Writing a blog post is easy. Writing an <strong>engaging</strong> blog post that keeps readers coming back is an art. Here are some tips from professional bloggers to help you craft posts that stand out.</p>
                <h3>1. Start with a Strong Headline</h3>
                <p>Your headline is the first thing readers see. Make it catchy, clear, and relevant to your content.</p>
                <h3>2. Use Images to Break Up Text</h3>
                <p>Images make your posts more visually appealing and help illustrate your points.</p>
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80" alt="Nature" style="max-width:100%;border-radius:8px;">
                <h3>3. Write in Short Paragraphs</h3>
                <ul>
                    <li>Short paragraphs are easier to read on screens.</li>
                    <li>Use bullet points and lists to organize information.</li>
                </ul>
                <h3>4. End with a Call to Action</h3>
                <p>Encourage your readers to comment, share, or check out related posts.</p>
                <h3>Example of a Long-Form Section</h3>
                <p>
                    Blogging is a journey. The more you write, the better you get. Don’t be afraid to experiment with different styles, topics, and formats. 
                    <br><br>
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Blogging" style="max-width:100%;border-radius:8px;">
                    <br><br>
                    Remember, the key to success is consistency and authenticity. Happy blogging!
                </p>
                <h3>Resources</h3>
                <ul>
                    <li><a href="https://copyblogger.com">Copyblogger</a> for writing tips</li>
                    <li><a href="https://unsplash.com">Unsplash</a> for free images</li>
                </ul>
                <p>' . str_repeat('Great content is the heart of every successful blog. ', 40) . '</p>
            ',
            'user_id' => $editorIds[array_rand($editorIds)],
        ]);

        Article::create([
            'title' => "Productivity Hacks for Developers: Work Smarter, Not Harder",
            'content' => '
                <h2>Introduction</h2>
                <p>Being a developer is not just about writing code—it’s about solving problems efficiently. Here are some productivity hacks to help you get more done in less time.</p>
                <h3>1. Use Keyboard Shortcuts</h3>
                <ul>
                    <li>Learn your editor’s shortcuts for faster navigation.</li>
                    <li>Automate repetitive tasks with snippets and macros.</li>
                </ul>
                <h3>2. Take Regular Breaks</h3>
                <p>Use the Pomodoro Technique: 25 minutes of focused work, followed by a 5-minute break.</p>
                <img src="https://images.unsplash.com/photo-1465101178521-c1a9136a3b99?auto=format&fit=crop&w=600&q=80" alt="Teamwork" style="max-width:100%;border-radius:8px;">
                <h3>3. Organize Your Workspace</h3>
                <ul>
                    <li>Keep your desk tidy and clutter-free.</li>
                    <li>Use tools like Trello or Notion to track tasks.</li>
                </ul>
                <h3>4. Learn to Say No</h3>
                <p>Don’t take on too many projects at once. Focus on what matters most.</p>
                <h3>Conclusion</h3>
                <p>Productivity is about working smarter, not harder. Try these tips and see your efficiency soar!</p>
                <p>' . str_repeat('Stay focused and keep improving. ', 35) . '</p>
            ',
            'user_id' => $editorIds[array_rand($editorIds)],
        ]);
    }
} 