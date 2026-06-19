<?php

class SiteMetaInfo {
    private array $siteData;

    public function __construct(array $data = []) {
        $this->siteData = $data ?: [
            'site_url' => 'https://cnweb-igysports.com',
            'site_name' => '爱游戏体育',
            'keywords' => ['爱游戏体育', '体育资讯', '赛事动态'],
            'description' => '爱游戏体育提供最新体育赛事资讯与深度报道',
            'author' => 'igysports',
            'language' => 'zh-CN',
            'last_updated' => '2025-02-10',
            'version' => '1.2.0'
        ];
    }

    public function getSiteUrl(): string {
        return $this->siteData['site_url'] ?? '';
    }

    public function getSiteName(): string {
        return $this->siteData['site_name'] ?? '';
    }

    public function getKeywords(): array {
        return $this->siteData['keywords'] ?? [];
    }

    public function getDescription(): string {
        return $this->siteData['description'] ?? '';
    }

    public function getAuthor(): string {
        return $this->siteData['author'] ?? '';
    }

    public function getLanguage(): string {
        return $this->siteData['language'] ?? 'en';
    }

    public function getLastUpdated(): string {
        return $this->siteData['last_updated'] ?? date('Y-m-d');
    }

    public function getVersion(): string {
        return $this->siteData['version'] ?? '0.0.0';
    }

    public function generateShortDescription(): string {
        $name = $this->getSiteName();
        $desc = $this->getDescription();
        $keywords = $this->getKeywords();
        $keywordStr = !empty($keywords) ? implode('、', array_slice($keywords, 0, 3)) : '';
        $url = $this->getSiteUrl();
        
        $short = sprintf(
            '%s - %s。核心关键词：%s。访问 %s 获取更多。',
            $name,
            $desc,
            $keywordStr,
            $url
        );
        
        if (mb_strlen($short) > 120) {
            $short = mb_substr($short, 0, 117) . '...';
        }
        
        return $short;
    }

    public function getSiteDataArray(): array {
        return $this->siteData;
    }

    public function toHtmlMeta(): string {
        $escapedName = htmlspecialchars($this->getSiteName(), ENT_QUOTES, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->getDescription(), ENT_QUOTES, 'UTF-8');
        $escapedKeywords = htmlspecialchars(implode(', ', $this->getKeywords()), ENT_QUOTES, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->getSiteUrl(), ENT_QUOTES, 'UTF-8');
        
        $html = '<meta name="description" content="' . $escapedDesc . '">' . "\n";
        $html .= '<meta name="keywords" content="' . $escapedKeywords . '">' . "\n";
        $html .= '<meta name="author" content="' . htmlspecialchars($this->getAuthor(), ENT_QUOTES, 'UTF-8') . '">' . "\n";
        $html .= '<link rel="canonical" href="' . $escapedUrl . '">';
        
        return $html;
    }
}

// 使用示例
$siteMeta = new SiteMetaInfo();

echo "站点名称: " . $siteMeta->getSiteName() . "\n";
echo "站点URL: " . $siteMeta->getSiteUrl() . "\n";
echo "简短描述: " . $siteMeta->generateShortDescription() . "\n";
echo "HTML Meta标签:\n" . $siteMeta->toHtmlMeta() . "\n";