"""Generate Erwin_Padilla_Resume.pdf from current portfolio resume content."""

from __future__ import annotations

from pathlib import Path

from fpdf import FPDF


OUTPUT = Path(__file__).resolve().parents[1] / "assets" / "downloads" / "Erwin_Padilla_Resume.pdf"


class ResumePDF(FPDF):
    def header(self) -> None:
        pass

    def footer(self) -> None:
        pass


def section_title(pdf: FPDF, title: str) -> None:
    pdf.set_font("Helvetica", "B", 11)
    pdf.set_text_color(30, 62, 187)
    pdf.cell(0, 8, title.upper(), ln=1)
    pdf.set_text_color(0, 0, 0)
    pdf.ln(1)


def body_text(pdf: FPDF, text: str) -> None:
    pdf.set_font("Helvetica", "", 10)
    pdf.set_x(pdf.l_margin)
    pdf.multi_cell(pdf.epw, 5, text)
    pdf.ln(2)


def bullet_list(pdf: FPDF, items: list[str]) -> None:
    pdf.set_font("Helvetica", "", 10)
    for item in items:
        pdf.set_x(pdf.l_margin)
        pdf.multi_cell(pdf.epw, 5, f"- {item}")
    pdf.ln(2)


def job_block(pdf: FPDF, title: str, company: str, period: str, bullets: list[str]) -> None:
    pdf.set_font("Helvetica", "B", 10)
    pdf.cell(0, 5, title, ln=1)
    pdf.set_font("Helvetica", "I", 10)
    pdf.cell(0, 5, f"{company} | {period}", ln=1)
    bullet_list(pdf, bullets)


def main() -> None:
    pdf = ResumePDF()
    pdf.set_auto_page_break(auto=True, margin=18)
    pdf.add_page()
    pdf.set_margins(18, 18, 18)

    pdf.set_font("Helvetica", "B", 18)
    pdf.cell(0, 10, "ERWIN D. PADILLA", ln=1)

    pdf.set_font("Helvetica", "B", 11)
    pdf.cell(0, 6, "Senior PHP Full-Stack Developer | Laravel, Drupal, AWS", ln=1)

    pdf.set_font("Helvetica", "", 10)
    pdf.cell(
        0,
        6,
        "London, ON | +1 (416) 505-3876 | ruizerwin@hotmail.com | www.ruizerwin.com",
        ln=1,
    )
    pdf.ln(4)

    section_title(pdf, "Summary")
    body_text(
        pdf,
        "Senior PHP Full-Stack Developer with 17+ years of experience since 2007 designing, "
        "developing, and maintaining enterprise web applications in Laravel, Livewire, "
        "CodeIgniter, Drupal, PHP 8.2+, MySQL, SQL Server, JavaScript, Bootstrap, Tailwind CSS, "
        "REST APIs, and AWS cloud hosting. Optimizing application performance, integrating "
        "third-party services, and delivering scalable solutions in remote environments. "
        "Strong problem-solving, debugging, and database design skills with extensive "
        "experience supporting business-critical applications.",
    )

    section_title(pdf, "Experience")
    job_block(
        pdf,
        "PHP / Web Developer",
        "J&B Importers - Remote",
        "2007 - 2022",
        [
            "Developed and maintained large-scale B2B and e-commerce applications serving customers across North America.",
            "Designed and implemented custom PHP applications, APIs, and database-driven business solutions.",
            "Integrated SQL Server, MySQL, UPS APIs, payment gateways, and third-party business services.",
            "Optimized application performance and database queries, significantly reducing response times.",
            "Managed Linux and Windows hosting environments, deployments, troubleshooting, and production support.",
            "Collaborated with business stakeholders to translate operational requirements into technical solutions.",
        ],
    )
    job_block(
        pdf,
        "Web Developer",
        "Haya Solutions - Remote",
        "2023",
        [
            "Built and implemented RESTful APIs using CodeIgniter to integrate with third-party services.",
            "Improved development time by 20% through cleaner architecture and reusable components.",
            "Developed custom functions to extend features and support client requirements.",
        ],
    )
    job_block(
        pdf,
        "Drupal Developer",
        "Y Partners Inc. - Remote",
        "2024 - 2025",
        [
            "Created, maintained, and optimized Drupal CMS features to improve speed and stability.",
            "Worked with front-end teams to build modern, mobile-friendly interfaces using Twig and Bootstrap.",
            "Built custom Drupal modules to support business logic and new system functionality.",
            "Reduced load time by 30% through optimization and content-structure improvements.",
        ],
    )

    section_title(pdf, "Skills")
    body_text(
        pdf,
        "PHP 8.2+, Laravel, Livewire, CodeIgniter 4, Drupal 9/10, MySQL, SQL Server, "
        "Stored Procedures, Query Optimization, JavaScript, jQuery, AJAX, Bootstrap 5, "
        "Tailwind CSS, Alpine.js, REST APIs, Third-Party Integrations, AWS Lightsail, "
        "Linux Administration, Apache, SSH, Git, GitHub, VS Code, Xdebug, Deployment Pipelines, "
        "Performance Optimization, Security Best Practices",
    )

    section_title(pdf, "Education")
    pdf.set_font("Helvetica", "B", 10)
    pdf.cell(0, 5, "Artificial Intelligence & Machine Learning", ln=1)
    pdf.set_font("Helvetica", "I", 10)
    pdf.cell(0, 5, "Fanshawe College - London, ON | Currently studying | Post-Graduate Co-op Certificate", ln=1)
    body_text(
        pdf,
        "GAP5 culmination. One-year program focused on building, managing, and administering "
        "systems that analyze big data and convert it into autonomous tasks. Covers AI, machine "
        "learning, and data-driven automation.",
    )

    pdf.set_font("Helvetica", "B", 10)
    pdf.cell(0, 5, "Bachelor's Degree in Computer Science", ln=1)
    pdf.set_font("Helvetica", "I", 10)
    pdf.cell(0, 5, "National Autonomous University of Nicaragua UNAN - Leon, Nicaragua | 1997 - 2003", ln=1)
    pdf.ln(2)

    pdf.set_font("Helvetica", "B", 10)
    pdf.cell(0, 5, "Cloud Architecture", ln=1)
    pdf.set_font("Helvetica", "I", 10)
    pdf.cell(0, 5, "Intellipaat, Mississauga, ON", ln=1)
    pdf.ln(2)

    pdf.set_font("Helvetica", "B", 10)
    pdf.cell(0, 5, "Computer Networking, Maintenance & Web Development", ln=1)
    pdf.set_font("Helvetica", "I", 10)
    pdf.cell(0, 5, "Leon, Nicaragua", ln=1)

    OUTPUT.parent.mkdir(parents=True, exist_ok=True)
    pdf.output(str(OUTPUT))
    print(f"Wrote {OUTPUT}")


if __name__ == "__main__":
    main()
