<?php
namespace App\Core;
class View
{
    private String $templateName;
    private String $viewName;
    private array $data = [];

    public function __construct(string $viewName, string $templateName = "back")
    {
        $this->setViewName($viewName);
        $this->setTemplateName($templateName);
    }

    /**
     * @param String $templateName
     */
    public function setTemplateName(string $templateName): void
    {
        if(!file_exists("Views/Templates/".$templateName.".tpl.php"))
        {
            die("Le template Views/Templates/".$templateName.".tpl.php n'existe pas");
        }
        $this->templateName = "Views/Templates/".$templateName.".tpl.php";
    }

    /**
     * @param String $viewName
     */
    public function setViewName(string $viewName): void
    {
        if(!file_exists("Views/".$viewName.".view.php"))
        {
            die("La vue Views/".$viewName.".view.php n'existe pas");
        }
        $this->viewName = "Views/".$viewName.".view.php";
    }

    public function assign(string $key, $value): void
    {
        $this->data[$key]=$value;
    }

    public function includeComponent(string $component, array $config, array $data = []): void
    {
        if(!file_exists("Views/Components/".$component.".php"))
        {
            die("Le composant Views/Components/".$component.".php n'existe pas");
        }
        include "Views/Components/".$component.".php";
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->templateName;
    }

}