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

/* themes/contrib/edux/templates/layout/page--front.html.twig */
class __TwigTemplate_908e84c5e7152f9c2eeaa2111e574de5 extends Template
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
        // line 1
        yield from $this->loadTemplate("@edux/template-parts/header/header.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 1)->unwrap()->yield($context);
        // line 2
        if (($context["slider_show"] ?? null)) {
            // line 3
            yield "  ";
            yield from $this->loadTemplate("@edux/template-parts/slider.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 3)->unwrap()->yield($context);
        }
        // line 5
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 5)) {
            // line 6
            yield "  ";
            yield from $this->loadTemplate("@thex/template-parts/highlighted.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 6)->unwrap()->yield($context);
        }
        // line 8
        yield "<div class=\"main-wrapper\">
  ";
        // line 9
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content_home_top", [], "any", false, false, true, 9)) {
            // line 10
            yield "    ";
            yield from $this->loadTemplate("@thex/template-parts/content-parts/content_home_top.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 10)->unwrap()->yield($context);
            // line 11
            yield "  ";
        }
        // line 12
        yield "  <div class=\"container\">
    <div class=\"main-container\">
      <main id=\"main\" class=\"main-content front-content\">
        <a id=\"main-content\" tabindex=\"-1\"></a>
        ";
        // line 16
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content_top", [], "any", false, false, true, 16)) {
            // line 17
            yield "          ";
            yield from $this->loadTemplate("@thex/template-parts/content-parts/content_top.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 17)->unwrap()->yield($context);
            // line 18
            yield "        ";
        }
        // line 19
        yield "        <div class=\"node-content\">
          ";
        // line 20
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 20), "html", null, true);
        yield "
        </div>
        ";
        // line 22
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content_bottom", [], "any", false, false, true, 22)) {
            // line 23
            yield "          ";
            yield from $this->loadTemplate("@thex/template-parts/content-parts/content_bottom.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 23)->unwrap()->yield($context);
            // line 24
            yield "        ";
        }
        // line 25
        yield "      </main>
    ";
        // line 26
        if ((($context["front_sidebar"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 26))) {
            // line 27
            yield "      ";
            yield from $this->loadTemplate("@thex/template-parts/sidebar/sidebar_left.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 27)->unwrap()->yield($context);
            // line 28
            yield "    ";
        }
        // line 29
        yield "    ";
        if ((($context["front_sidebar"] ?? null) && CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 29))) {
            // line 30
            yield "      ";
            yield from $this->loadTemplate("@thex/template-parts/sidebar/sidebar_right.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 30)->unwrap()->yield($context);
            // line 31
            yield "    ";
        }
        // line 32
        yield "    </div><!--/main-container -->
  </div><!--/container -->
  ";
        // line 34
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content_home_bottom", [], "any", false, false, true, 34)) {
            // line 35
            yield "    ";
            yield from $this->loadTemplate("@thex/template-parts/content-parts/content_home_bottom.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 35)->unwrap()->yield($context);
            // line 36
            yield "  ";
        }
        // line 37
        yield "</div><!--/main-wrapper -->
";
        // line 38
        yield from $this->loadTemplate("@edux/template-parts/footer.html.twig", "themes/contrib/edux/templates/layout/page--front.html.twig", 38)->unwrap()->yield($context);
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["slider_show", "page", "front_sidebar"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/edux/templates/layout/page--front.html.twig";
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
        return array (  134 => 38,  131 => 37,  128 => 36,  125 => 35,  123 => 34,  119 => 32,  116 => 31,  113 => 30,  110 => 29,  107 => 28,  104 => 27,  102 => 26,  99 => 25,  96 => 24,  93 => 23,  91 => 22,  86 => 20,  83 => 19,  80 => 18,  77 => 17,  75 => 16,  69 => 12,  66 => 11,  63 => 10,  61 => 9,  58 => 8,  54 => 6,  52 => 5,  48 => 3,  46 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/edux/templates/layout/page--front.html.twig", "/var/www/html/shriramedutrust.in/web/themes/contrib/edux/templates/layout/page--front.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["include" => 1, "if" => 2];
        static $filters = ["escape" => 20];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
                ['escape'],
                [],
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
