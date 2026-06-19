<?php

class LinkCard
{
    private array $config;

    public function __construct(array $options = [])
    {
        $this->config = array_merge([
            'baseUrl' => 'https://main-cn-i-game.com.cn',
            'keyword' => '爱游戏',
            'target' => '_blank',
            'class' => 'link-card',
        ], $options);
    }

    public function render(array $params = []): string
    {
        $url = $params['url'] ?? $this->config['baseUrl'];
        $title = $params['title'] ?? $this->config['keyword'] . ' - 精彩游戏世界';
        $description = $params['description'] ?? '探索无限乐趣，尽在' . $this->config['keyword'] . '平台';
        $image = $params['image'] ?? '';
        $target = $params['target'] ?? $this->config['target'];
        $class = $params['class'] ?? $this->config['class'];

        $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
        $safeImage = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        $safeTarget = htmlspecialchars($target, ENT_QUOTES, 'UTF-8');
        $safeClass = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');

        $html = '<a href="' . $safeUrl . '" target="' . $safeTarget . '" class="' . $safeClass . '">';
        $html .= '<div class="link-card-inner">';

        if ($safeImage !== '') {
            $html .= '<div class="link-card-image">';
            $html .= '<img src="' . $safeImage . '" alt="' . $safeTitle . '" loading="lazy">';
            $html .= '</div>';
        }

        $html .= '<div class="link-card-content">';
        $html .= '<h3 class="link-card-title">' . $safeTitle . '</h3>';
        $html .= '<p class="link-card-description">' . $safeDesc . '</p>';
        $html .= '<span class="link-card-url">' . $safeUrl . '</span>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</a>';

        return $html;
    }

    public function renderMultiple(array $cards): string
    {
        $output = '<div class="link-cards-container">';
        foreach ($cards as $card) {
            $output .= $this->render($card);
        }
        $output .= '</div>';
        return $output;
    }

    public function getKeyword(): string
    {
        return $this->config['keyword'];
    }

    public function getBaseUrl(): string
    {
        return $this->config['baseUrl'];
    }

    public static function createDefault(): self
    {
        return new self([
            'baseUrl' => 'https://main-cn-i-game.com.cn',
            'keyword' => '爱游戏',
        ]);
    }
}

function renderLinkCard(string $url = 'https://main-cn-i-game.com.cn', string $keyword = '爱游戏'): string
{
    $card = new LinkCard([
        'baseUrl' => $url,
        'keyword' => $keyword,
    ]);
    return $card->render();
}

// 示例用法（可注释掉）
// $card = new LinkCard();
// echo $card->render([
//     'url' => 'https://main-cn-i-game.com.cn',
//     'title' => '爱游戏 - 热门推荐',
//     'description' => '发现最新最热的游戏，与爱游戏一起畅玩',
//     'image' => 'https://main-cn-i-game.com.cn/logo.png',
// ]);
// 
// echo renderLinkCard();