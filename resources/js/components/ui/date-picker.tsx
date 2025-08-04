import { format, parseISO } from "date-fns";
import { CalendarIcon } from "lucide-react";
import { cn } from "@/lib/utils";
import { Button } from "./button";
import { Calendar } from "./calendar";
import { Popover, PopoverContent, PopoverTrigger } from "./popover";

interface DatePickerProps {
    date: string | null;
    setDate: (newDate: string) => void;
    label: string;
}

export default function DatePicker({ date, setDate, label }: DatePickerProps) {
    const handleDataChange = (selectedDate: Date | undefined) => {
        if (selectedDate) {
            const formattedDate = format(selectedDate, "yyyy-MM-dd");
            setDate(formattedDate);
        }
    };

    return (
        <Popover>
            <PopoverTrigger asChild>
                <Button variant={"outline"} size="input" className={cn("w-full justify-start text-left font-normal darl:bg-gray900 dark:hover:bg-gray-900 focus:ring-1 focus:ring-indigo-500", !date && "dark:text-gray-400")}>
                    <CalendarIcon />
                    {date ? format(parseISO(date), "PPP") : <span>{label}</span>}
                </Button>
            </PopoverTrigger>
            <PopoverContent className="w-auto p-0" align="start">
                <Calendar
                    mode="single"
                    selected={date ? parseISO(date) : undefined}
                    onSelect={handleDataChange} />
            </PopoverContent>
        </Popover>
    );
}
