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

/* @edux/template-parts/slider.html.twig */
class __TwigTemplate_efdbf5d95fd4cda39573a00c9fdcf69a extends Template
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
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("edux/slider"), "html", null, true);
        yield "
<section class=\"slider\">
  <div class=\"container slider-container\">
    <div class=\"slider-text\">
      <ul class=\"js-rotating\">
        ";
        // line 6
        if ((($context["slider_code"] ?? null) != "")) {
            // line 7
            yield "          ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::striptags(($context["slider_code"] ?? null), "<ol>,<ul>,<li>,<p>,<a>,<img>,<video>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<em>,<strong>,<br>,<i>,<button>,<mark>,<hr>"));
            yield "
        ";
        } else {
            // line 9
            yield "        <li>
  \t\t\t\t<h1>Limitless <em>Learning</em> And Get More Possibilities</h1>
  \t\t\t\t<p>EduX Theme is packed full of all the amazing features and options for you to create an amazing education website.</p>
  \t\t\t\t<a class=\"button-dark\" href=\"#\">Get Started</a>
  \t\t\t</li>
  \t\t\t<li>
  \t\t\t\t<h1><em>Pratical</em> Teachings and <em>Social</em> Development</h1>
  \t\t\t\t<p>Learn anytime with our free online study materials and videos. Get your doubts cleared by expert teachers.</p>
  \t\t\t\t<a class=\"button-dark\" href=\"#\">Get Started</a>
  \t\t\t</li>
  \t\t\t<li>
  \t\t\t\t<h1>Learn New <em>Skills</em>, Advance Your <em>Career</em></h1>
  \t\t\t\t<p>We have high academic programs and fully qualified faculties with over 12 years of teaching experience.</p>
  \t\t\t\t<a class=\"button-dark\" href=\"#\">Get Started</a>
  \t\t\t</li>
        ";
        }
        // line 25
        yield "      </ul> <!--/.home-slider -->
    </div><!-- /slider-text -->
    <div class=\"slider-image\">
      ";
        // line 28
        if ((($context["slider_image_path"] ?? null) != "")) {
            // line 29
            yield "        <img src=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["slider_image_path"] ?? null), "html", null, true);
            yield "\" alt=\"slider image\" />
      ";
        } else {
            // line 31
            yield "        <img src=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["directory"] ?? null), "html", null, true);
            yield "/images/demo/slider.svg\" alt=\"slider image\" />
      ";
        }
        // line 33
        yield "    </div><!-- /slider-image -->
  </div> <!--/.container -->
</section>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["slider_code", "slider_image_path", "directory"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "@edux/template-parts/slider.html.twig";
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
        return array (  97 => 33,  91 => 31,  85 => 29,  83 => 28,  78 => 25,  60 => 9,  54 => 7,  52 => 6,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "@edux/template-parts/slider.html.twig", "/var/www/html/shriramedutrust.in/web/themes/contrib/edux/templates/template-parts/slider.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 6];
        static $filters = ["escape" => 1, "raw" => 7, "striptags" => 7];
        static $functions = ["attach_library" => 1];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'raw', 'striptags'],
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
