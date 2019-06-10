<?php


namespace src\Entity;


class Critique
{
    /**
     * @var int
     */
    private $critique_id;
    /**
     * @var string
     */
    private $critique_titre;
    /**
     * @var string
     */
    private $critique_description;

    /**
     * @return int
     */
    public function getCritiqueId(): int
    {
        return $this->critique_id;
    }

    /**
     * @param int $critique_id
     */
    public function setCritiqueId(int $critique_id): void
    {
        $this->critique_id = $critique_id;
    }

    /**
     * @return string
     */
    public function getCritiqueTitre(): string
    {
        return $this->critique_titre;
    }

    /**
     * @param string $critique_titre
     */
    public function setCritiqueTitre(string $critique_titre): void
    {
        $this->critique_titre = $critique_titre;
    }

    /**
     * @return string
     */
    public function getCritiqueDescription(): string
    {
        return $this->critique_description;
    }

    /**
     * @param string $critique_description
     */
    public function setCritiqueDescription(string $critique_description): void
    {
        $this->critique_description = $critique_description;
    }

}