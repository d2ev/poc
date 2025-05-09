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

/* modules/contrib/accessibility_menu/templates/accessibility-menu.html.twig */
class __TwigTemplate_095ab236ca726b71ebd7001fed65bfd9 extends Template
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
        yield "<div class=\"b-accessibility-menu__button js-accessibility-btn am-skip\" id=\"b-accessibility-menu\"></div>

<div class=\"b-accessibility-menu__wrapper js-accessibility-menu am-skip\">
  <div class=\"b-accessibility-menu am-skip\">
    <div class=\"b-accessibility-menu__header am-skip\">
      <div class=\"b-accessibility-menu__title am-skip\">";
        // line 6
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Accessibility menu"));
        yield "</div>
      <div class=\"b-accessibility-menu__close js-accessibility-close am-skip\"></div>
    </div>
    <div class=\"b-accessibility-menu__content am-skip\">
      <div class=\"b-accessibility-menu__items am-skip\">
        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["info"] ?? null), "items", [], "any", false, false, true, 11));
        foreach ($context['_seq'] as $context["type"] => $context["item"]) {
            // line 12
            yield "          ";
            if (CoreExtension::getAttribute($this->env, $this->source, $context["item"], "access", [], "any", false, false, true, 12)) {
                // line 13
                yield "          <div class=\"b-accessibility-menu__item-wrapper am-skip\">
            <div class=\"b-accessibility-menu__item am-skip type-";
                // line 14
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["type"], "html", null, true);
                yield "\" data-type=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["type"], "html", null, true);
                yield "\" data-title=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 14), "html", null, true);
                yield "\">
              <div class=\"b-accessibility-menu__title am-skip\"><span class=\"am-skip\">";
                // line 15
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 15), "html", null, true);
                yield "</span></div>
              <div class=\"b-accessibility-menu__links am-skip\">
                ";
                // line 17
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "options", [], "any", false, false, true, 17));
                foreach ($context['_seq'] as $context["id"] => $context["option"]) {
                    // line 18
                    yield "                  <div class=\"b-accessibility-menu__link js-accessibility-link am-skip\" data-title=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "title", [], "any", false, false, true, 18), "html", null, true);
                    yield "\"></div>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['id'], $context['option'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                yield "              </div>
            </div>
          </div>
          ";
            }
            // line 24
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['type'], $context['item'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "      </div>
      <div class=\"b-accessibility-menu__reset js-accessibility-reset am-skip\">";
        // line 26
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Reset the settings"));
        yield "</div>
    </div>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["info"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/accessibility_menu/templates/accessibility-menu.html.twig";
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
        return array (  110 => 26,  107 => 25,  101 => 24,  95 => 20,  86 => 18,  82 => 17,  77 => 15,  69 => 14,  66 => 13,  63 => 12,  59 => 11,  51 => 6,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/contrib/accessibility_menu/templates/accessibility-menu.html.twig", "/var/www/html/shriramedutrust.in/web/modules/contrib/accessibility_menu/templates/accessibility-menu.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 11, "if" => 12];
        static $filters = ["t" => 6, "escape" => 14];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['t', 'escape'],
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
