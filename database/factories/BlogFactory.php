<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        $categories = ['Technology', 'AI', 'Programming', 'Lifestyle', 'Productivity', 'Startups', 'Design', 'Travel', 'Fitness', 'Self Growth'];

        // Expanded pool of 40+ curated premium dark/SaaS Unsplash image IDs
        $images = [
            'photo-1498050108023-c5249f4df085', 'photo-1555066931-4365d14bab8c', 'photo-1504384308090-c894fdcc538d',
            'photo-1486312338219-ce68d2c6f44d', 'photo-1522202176988-66273c2fd55f', 'photo-1517245386807-bb43f82c33c4',
            'photo-1551288049-bebda4e38f71', 'photo-1454165804606-c3d57bc86b40', 'photo-1434030216411-0b793f4b4173',
            'photo-1517048676732-d65bc937f952', 'photo-1499750310107-5fef28a66643', 'photo-1526304640581-d334cdbbf45e',
            'photo-1504639725590-34d0984388bd', 'photo-1487058792275-0ad4aaf24ca7', 'photo-1531297172864-fdf2c9748b8d',
            'photo-1550751827-4bd374c3f58b', 'photo-1518770660439-4636190af475', 'photo-1526374965328-7f61d4dc18c5',
            'photo-1451187580459-43490279c0fa', 'photo-1484417894907-623942c8ee29', 'photo-1519389950473-47ba0277781c',
            'photo-1501504905252-473c47e087f8', 'photo-1488590528505-98d2b5aba04b', 'photo-1504384764586-bb4cdc1707b0',
            'photo-1515879218367-8466d910aaa4', 'photo-1496065187959-7f07b8353c55', 'photo-1550745165-9bc0b252726f',
            'photo-1535223289827-42f1e9919769', 'photo-1507238691740-187a5b1d37b8', 'photo-1518932945647-7a3c96943e92',
            'photo-1525547719571-a2d4ac8945e2', 'photo-1461749280684-dccba630e2f6', 'photo-1516321318423-f06f85e504b3',
            'photo-1523961131990-5ea7c6145d84', 'photo-1497366216548-37526070297c', 'photo-1517430816045-df4b7de11d1d'
        ];
        
        // Remove the selected image from the pool temporarily to ensure strict uniqueness
        static $availableImages = null;
        if ($availableImages === null || count($availableImages) === 0) {
            $availableImages = $images;
        }
        
        $imageKey = array_rand($availableImages);
        $randomImage = $availableImages[$imageKey];
        unset($availableImages[$imageKey]); // Ensure it doesn't repeat until pool is empty

        // Build realistic HTML content with headings, lists, code block, and images
        $paragraph = fn($sentences = 5) => '<p>' . implode(' ', $this->faker->sentences($sentences)) . '</p>';
        $heading = fn($lvl = 2) => '<h' . $lvl . '>' . ucfirst($this->faker->sentence(mt_rand(3,6))) . '</h' . $lvl . '>';
        $list = fn() => '<ul><li>' . implode('</li><li>', $this->faker->sentences(mt_rand(3,5))) . '</li></ul>';
    $js = <<<'JS'
// Example snippet
function greet(name) {
  return `Hello ${name}`;
}
JS;

    $code = '<pre><code>' . htmlspecialchars($js) . '</code></pre>';
        $blockquote = '<blockquote>' . $this->faker->sentence(mt_rand(10,18)) . '</blockquote>';

        $contentParts = [];
        $contentParts[] = $heading(2);
        $contentParts[] = $paragraph(4);
        if (rand(0,1)) $contentParts[] = $list();
        $contentParts[] = $paragraph(3);
        if (rand(0,1)) $contentParts[] = $blockquote;
        if (rand(0,1)) $contentParts[] = $code;
        $contentParts[] = '<p><strong>Key takeaway:</strong> ' . $this->faker->sentence(8) . '</p>';

        $htmlContent = implode("\n", $contentParts);

        return [
            'title' => ucfirst($this->faker->catchPhrase()),
            'content' => $htmlContent,
            'category' => $this->faker->randomElement(['Latest Jobs','Results','Admit Cards','Government Jobs','Internships','Technology','AI','Programming','Productivity']),
            'image' => 'https://images.unsplash.com/' . $randomImage . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }
}
