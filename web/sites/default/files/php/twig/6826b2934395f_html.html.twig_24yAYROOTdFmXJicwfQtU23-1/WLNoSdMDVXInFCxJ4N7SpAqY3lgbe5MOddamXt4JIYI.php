<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/contrib/edux/templates/layout/html.html.twig */
class __TwigTemplate_b2fbafd517b3039188dd6d250129811d extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 28
        $context["body_classes"] = [(( !        // line 29
($context["root_path"] ?? null)) ? ("homepage") : ("site-page")), ((        // line 30
($context["node_type"] ?? null)) ? (("page-type-" . \Drupal\Component\Utility\Html::getClass(($context["node_type"] ?? null)))) : ("")), ((        // line 31
($context["logged_in"] ?? null)) ? ("user-logged-in") : ("user-guest")), ((( !CoreExtension::getAttribute($this->env, $this->source,         // line 32
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 32) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 32))) ? ("no-sidebar") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 33
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 33) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 33))) ? ("one-sidebar sidebar-left") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 34
($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 34) &&  !CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 34))) ? ("one-sidebar sidebar-right") : ("")), (((CoreExtension::getAttribute($this->env, $this->source,         // line 35
($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 35) && CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 35))) ? ("two-sidebar") : (""))];
        // line 38
        yield "<!DOCTYPE html>
<html";
        // line 39
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["html_attributes"] ?? null), "html", null, true);
        yield ">
  <head>
    <head-placeholder token=\"";
        // line 41
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
    <title>";
        // line 42
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->safeJoin($this->env, ($context["head_title"] ?? null), " | "));
        yield "</title>
    ";
        // line 43
        if ((($context["font_src"] ?? null) == "local")) {
            // line 44
            yield "    <link rel=\"preload\" as=\"font\" href=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($context["base_path"] ?? null) . ($context["directory"] ?? null)), "html", null, true);
            yield "/fonts/noto-sans.woff2\" type=\"font/woff2\" crossorigin>
    <link rel=\"preload\" as=\"font\" href=\"";
            // line 45
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($context["base_path"] ?? null) . ($context["directory"] ?? null)), "html", null, true);
            yield "/fonts/noto-sans-bold.woff2\" type=\"font/woff2\" crossorigin>
    ";
        } elseif ((        // line 46
($context["font_src"] ?? null) == "googlecdn")) {
            // line 47
            yield "    <link href=\"//fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap\" rel=\"stylesheet\">
    ";
        }
        // line 49
        yield "    <css-placeholder token=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
    <js-placeholder token=\"";
        // line 50
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
";
        // line 51
        if (($context["styling"] ?? null)) {
            // line 52
            yield "<style>
";
            // line 53
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["styling_code"] ?? null));
            yield "
</style>
";
        }
        // line 56
        yield "  </head>
  <body";
        // line 57
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["body_classes"] ?? null)], "method", false, false, true, 57), "html", null, true);
        yield ">
    ";
        // line 62
        yield "    <a href=\"#main-content\" class=\"visually-hidden focusable\">
      ";
        // line 63
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Skip to main content"));
        yield "
    </a>
    ";
        // line 65
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_top"] ?? null), "html", null, true);
        yield "
    ";
        // line 66
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page"] ?? null), "html", null, true);
        yield "
    ";
        // line 67
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["page_bottom"] ?? null), "html", null, true);
        yield "
    ";
        // line 68
        if ((($context["font_src"] ?? null) == "local")) {
            // line 69
            yield "      ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("edux/googlefontslocal"), "html", null, true);
            yield "
    ";
        }
        // line 71
        yield "    <js-bottom-placeholder token=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["placeholder_token"] ?? null), "html", null, true);
        yield "\">
    ";
        // line 72
        if (($context["is_front"] ?? null)) {
            // line 73
            yield "    <script>
    jQuery(\".js-rotating\").Morphist({
      animateIn: 'fadeInUp',
      animateOut: 'fadeOutLeft',
      speed: ";
            // line 77
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["slider_speed"] ?? null), "html", null, true);
            yield ",
    });
    </script>
    ";
        }
        // line 81
        yield "  </body>
</html>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["root_path", "node_type", "logged_in", "page", "html_attributes", "placeholder_token", "head_title", "font_src", "base_path", "directory", "styling", "styling_code", "attributes", "page_top", "page_bottom", "is_front", "slider_speed"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/edux/templates/layout/html.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  161 => 81,  154 => 77,  148 => 73,  146 => 72,  141 => 71,  135 => 69,  133 => 68,  129 => 67,  125 => 66,  121 => 65,  116 => 63,  113 => 62,  109 => 57,  106 => 56,  100 => 53,  97 => 52,  95 => 51,  91 => 50,  86 => 49,  82 => 47,  80 => 46,  76 => 45,  71 => 44,  69 => 43,  65 => 42,  61 => 41,  56 => 39,  53 => 38,  51 => 35,  50 => 34,  49 => 33,  48 => 32,  47 => 31,  46 => 30,  45 => 29,  44 => 28,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/edux/templates/layout/html.html.twig", "/var/www/html/shriramedutrust.in/web/themes/contrib/edux/templates/layout/html.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 28, "if" => 43];
        static $filters = ["clean_class" => 30, "escape" => 39, "safe_join" => 42, "raw" => 53, "t" => 63];
        static $functions = ["attach_library" => 69];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape', 'safe_join', 'raw', 't'],
                ['attach_library'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
